# Setup

This is all just suggestion, and a near-direct copy of how my setup works.

----

note: a `client_max_body_size` of more than the default (1m) is recommended.

### The "Backend" ("base url")

```conf
server {
    root /srv/http/image.example.org/public;

    index index.php index.html;

    server_name image.example.org.net;

    // ssl config

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php7.2-fpm.sock;
    }

    location / {
        try_files $uri $uri/ =404;
    }

    add_header Strict-Transport-Security "max-age=31536000; includeSubdomains; preload";
    add_header Content-Security-Policy "default-src 'self'";
    add_header X-Frame-Options sameorigin;
    add_header X-Content-Type-Options nosniff;
    add_header X-XSS-Protection "1; mode=block";
    add_header Referrer-Policy same-origin;
}

server {
    if ($host = image.example.org) {
        return 301 https://$host$request_uri;
    }

    listen 80;
    listen [::]:80;

    server_name image.example.org;
    return 404;
}
```

The CDN or the image serving config could have the following block;

```
    location /images {
        alias /srv/http/image.example.org/images;
    }
```
