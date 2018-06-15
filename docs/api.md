JSON api responses:

#### Image upload `POST` to `/upload.php`:

```json
{
    "urls": {
        "full": "full url for image / cdn",
        "delete": "deletion link"
    },
    "uploader": {
        "name": "set if header X-Sender is provided."
    },
    "file": {
        "name": "original ShareX filename",
        "size": "size in bytes",
        "type": "the type we detected, currently we hardcode png as file extension"
    },
    "meta": {
        "uploaded_on": "DateTime in iso8601 format"
    }
}
```

Or 401: Unauthorized (plain text) on any failure.

#### Deletion request `DELETE` to `/delete.php`:

```json
{
    "deleted": bool,
    "uploader": {
        "name": "set if header X-Sender is provided."
    },
    "meta": {
        "deleted_on": "DateTime in iso8601 format"
    }
}
```

Or 401: Unauthorized (plain text) on any failure.
