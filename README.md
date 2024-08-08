# aliyun internal unsecure api

## oss signed upload endpoint

```sh
curl 'http://your-host/api/oss-signed-endpoint?bucket={your-bucket}&name={filename.jpg}' \
    --header 'x-aliyun-id: {your access key}' \
    --header 'x-aliyun-key: {your secret key}' 
```
