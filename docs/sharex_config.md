# ShareX configuration

In ShareX, go to Destinations -> Custom Uploaders

Add a new Uploader, configure the following:

- Destination Type: `Image Uploader`
- Request Type: `POST`
- Request URL: URL identical to the baseUrl in `config.php`
- File form name: `sharex_image`
- Headers:
    - X-Authorization: `Your API key`
    - X-Uploader: `YourName`
- Response Type: `Response Text`
    - URL: `$json:.urls.full$`
    - Deletion URL: `$json:.urls.delete$`

You should do the same, but for Request Type `DELETE`, because at the moment
there is no UI to insert the API key in.

Test it, confirm it works.

If it doesn't, that's gonna suck, because we only send `401 Unauthorized` with no logging.
