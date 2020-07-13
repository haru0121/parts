FROM nginx:latest

MAINTAINER sample<sample@gmail.com>

# ドキュメントルート
COPY default.conf /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf

COPY .htpasswd /etc/nginx/.htpasswd
# ポート設定
EXPOSE 80
EXPOSE 443