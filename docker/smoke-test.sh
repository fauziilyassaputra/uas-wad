#!/bin/sh
# Smoke test aplikasi di dalam container.
#
# Pakai (dari root project, setelah `docker compose up -d --build`):
#   sh docker/smoke-test.sh
#   BASE_URL=http://localhost:8080 EMAIL=vivian@randomplay.id sh docker/smoke-test.sh
#
# Butuh data seed (user wise@randomplay.id / vivian@randomplay.id, password: password):
#   docker compose exec app php artisan db:seed --force
set -u

BASE_URL="${BASE_URL:-http://localhost:8080}"
EMAIL="${EMAIL:-wise@randomplay.id}"
PASSWORD="${PASSWORD:-password}"

JAR="$(mktemp)"
LOGIN_HTML="$(mktemp)"
FAILED=0

check() {
    label="$1"
    expected="$2"
    actual="$3"

    if [ "$expected" = "$actual" ]; then
        printf 'PASS  %-34s %s\n' "$label" "$actual"
    else
        printf 'FAIL  %-34s %s (harus %s)\n' "$label" "$actual" "$expected"
        FAILED=$((FAILED + 1))
    fi
}

code() {
    curl -s -k -o /dev/null -w '%{http_code}' "$@"
}

echo "== Smoke test: $BASE_URL =="
check "GET /up (health check)" 200 "$(code "$BASE_URL/up")"
check "GET /login" 200 "$(code "$BASE_URL/login")"
check "GET /register" 200 "$(code "$BASE_URL/register")"
check "GET /produk (tamu)" 302 "$(code "$BASE_URL/produk")"
check "GET /kategori (tamu)" 302 "$(code "$BASE_URL/kategori")"
check "GET /transaksi (tamu)" 302 "$(code "$BASE_URL/transaksi")"

# --- alur login (session + CSRF lewat database) ---
curl -s -k -c "$JAR" "$BASE_URL/login" -o "$LOGIN_HTML"
TOKEN="$(grep -o 'name="_token" value="[^"]*"' "$LOGIN_HTML" | head -1 | sed 's/.*value="//; s/"$//')"

if [ -z "$TOKEN" ]; then
    printf 'FAIL  %-34s %s\n' "POST /login" "token CSRF tidak ditemukan"
    FAILED=$((FAILED + 1))
else
    REDIRECT="$(curl -s -k -b "$JAR" -c "$JAR" -o /dev/null -w '%{redirect_url}' \
        -d "_token=$TOKEN&email=$EMAIL&password=$PASSWORD" "$BASE_URL/login")"

    case "$REDIRECT" in
        */produk) printf 'PASS  %-34s %s\n' "POST /login" "$REDIRECT" ;;
        *)        printf 'FAIL  %-34s %s\n' "POST /login" "${REDIRECT:-<kosong>}"
                  FAILED=$((FAILED + 1)) ;;
    esac

    check "GET /produk (login)" 200 "$(curl -s -k -b "$JAR" -o /dev/null -w '%{http_code}' "$BASE_URL/produk")"
    check "GET /kategori (login)" 200 "$(curl -s -k -b "$JAR" -o /dev/null -w '%{http_code}' "$BASE_URL/kategori")"
    check "GET /transaksi/create (login)" 200 "$(curl -s -k -b "$JAR" -o /dev/null -w '%{http_code}' "$BASE_URL/transaksi/create")"
fi

rm -f "$JAR" "$LOGIN_HTML"

echo
if [ "$FAILED" -eq 0 ]; then
    echo "SEMUA TES LULUS"
    exit 0
fi

echo "$FAILED TES GAGAL"
exit 1
