# 用户
·登录  
·登出  
·注册新用户  
·获取当前用户信息  
·完善用户信息  
·注销用户  
·获取某用户信息  
·我的发布  
·个人中心-我收到的回复
·个人中心-将收到的回复标为已读
·个人中心-我收到的赞
·个人中心-将收到的赞标为已读

## 登录
注意，这个可能不算是API，因为他会重定向到CAS登录界面。初次登陆会请求授权。
```html
GET {{webserver}}/login
```

```html
{
    "data": {
        "access_token": "eyJpdiI6ImF0RGJhMFBSUWhGK1Baa3R5WENTdkE9PSIsInZhbHVlIjoiWGZmSWxqWGhGcGRUM3VsNVlaUnNDWlVNTmh2aFkzbEIyQm5laVlEb2JNMUVtWDJuQmJzZzZ2MzBqa1J0dG92QjBFZG16a25OZDhYUFhvN3MzVVRaVk9SOGQ5Rm9QT2RQQmlTVXMrRFppcU9oVzN2YmVhalpIXC9RZGdtb3VsOXZFdWRVeTVXVzhjVFNUeEZZRFYyTHJpbnpqK2EzbUp3NjJvNmhWOE02RFYwbnA3WWx5RHdWMnpZM1ppejN3dWU2dHZoMUtVQU1KQm9QaW16NTVNRlUxU2FDZVFnanFEQlFYd05Qd043YndCa1RMZUkxMU5iVDh5aVdTT1pQQllFS3dIWFJOaWI1QUhHQ1JYZnZNUVhwekY3SExsd0ljdzhRSGFHRzBGVkRRR05CNFVpYUJRV0FXZEFsYzV5TFVsU3ZCNHc0RDRcL2JQMUxnZzE0aFJncHRmc3ZlNVZ0NWR4V1dKVzdzTlRYbFVJb3A1UnpTR01Tam5CWXpPckhhUFhOdmF2QmowTTJhdFd1MWQwanQ5NEp1YStaaDJzMGpyWVZteVlWRXJ2SUM4enBkUjU5QzlmVUdBTEhUaDBUbmlqN2k3aFVTakl2YmVJalJDVW41T0hySHZMc3JVVGYwYlR3OER1d0ZiUkhjcDZTUmdMVURNZkNwcW5LYUthZzlQVEVvcDV3UUNHWDN6cXZ6WmY2U040ek01WEpGYzFGY1FMUGM2NytOOFhEb21weDZhN0MzRU5cL3lsemVEOHVoSVRNVnYyZk5jMEVhQUdiRU81Qk51NnhsNnR4Y1YxK0Z3eFkzNXQ0ZGpZM0w2UDYzWGVzcXZ1QW9waDA0OFRUSDNHUDZHelcrNjhzUEl0N3UwR0Z1UDNMc3RRUkVZXC95ZVlOdDlaVVEwT1I3Nmd5ODltZ0V0Q0R3ejNCbFU0cmtIU2N6SFFhdnZVTE5idGpKXC9nZ0IzbXJ4RVM5WjMreXp4cTVTOFdPdEJcL3lkRVpTTXZTU3llT05lZ2pMNXdzbDFZS0lkT3RhQUhKM3RvYmN0R2pxMGU3VWFvZlZmMlJPUW5xY3BiV2ZnU2lNR2J3Q2NKV3F5dXg5QWprNmNKclJNbjIzbDNrMDdhYW9NTytUcHJORlAzS25KY2RFV1NTalZmaG9lN0NzYU5UUHVPWXhLWHltM2puQ3gzNVwvQ3Jqd1RPbTV0bUJHS3R5YURcL2dQUVpXanlDRkJuWjNxemxEN2xVaEk5V2xoS29EMnhjdzdsZldWeFFMcjUxZGFBZmlyMzByd2FsU2Z6SWJSUkVJdFFYRE1JWHhObTVTeG1jM0RUdGpFZUZ0T0Z3MkFvQ3IxR0hYUyt2MmVtWE1KV29cL0hVTnF1WG1JUVlTTng5cnlcL0xodFd6RWY3bVJXZG9IQmV1TkZtT2NPdjJGWE1nZ01hZyt3ZWprWG9ZSDY3QlwvK1greExWdW13SDl2ZFRKZzVLYURIQzFXMlwvNVNLMkFqUk9JRnp1MXRkYjhtcXNvSEFXaHBDRUNQZGRMaTB3TEJpOTNTUXBLNGNpYnpaYUJqZlBvdXk4ejhJblpmME53d29GOWRzVmNIMlliaE5ocW4yTlZVcVB3aFE3cEszZGc2QUZEZzFVYWt5UGpiUEg5SE1KNmc5ZTlTWXN4MHR1Unh1THRwVnlNK3RWVVFER1J2UlwvZFdVWSs4VHJNNFFXbklpcE9jaUZ1RGVZc2wrd2k4NTROTmRKbjhJUjhnR01TcTZoc1U2OXFxWXllUE9PczlOUGh3Zmk0YjFYNE94MWpCUTVwUEx2T3pLaVhVUUhocEM2Z3crRzdVWXBYSGQ5UEFaZTlBcElOSmNvT1ZcLzVQVlpPc0wxRzVWZTlMZ3FLNnlYaDlLWVJ0Y1d3SnV0cFlzTVJtZUI0OFhJM0p1cDR0dHRcLzg0dFpcL0wzWFFwZExpNHhRYWh1Z1BvcTlxNGNjS2l4WXFVT2FDRGEzNFF5UnlrbVBLSkw5ZGdsRDN4clMyS0VhWWI2RUVmcjIwZEdMZEY1RXdUbENpSlZHdHpENUYwV2hIRTFJbGNRWWYzQzlBeSt1VjBCc2g5OVJ5blwvejlnPT0iLCJtYWMiOiI4YzM0OWEyMTg5MWM3OWM4ZjdiNTkyYzI0Y2VhZTgzMTVlMDRlMGI4ZmE5NTQ5ZDY0N2QzNTBjYTlkNTlkZjE1In0=",
        "token_id": 1,
        "state": "http://workshop.test/login"
    },
    "code": 200
}
```
登录失败时返回40X
```
{
    "data": "Invalid state",
    "code": 401
}
```

## 登出
```html
GET {{webserver}}/logout
```

```html
该功能尚不可用，无返回内容。
```

## 注册新用户
需要在登陆后调用该接口

```html
POST {{server}}/users

token_id 由登陆接口返回的token_id
access_token 由登陆接口返回的access_token
nickname 昵称
signature 个性签名
email
email_access 邮箱是否公开，1表示公开，0表示不公开
phone
phone_access
qq
qq_access
```

成功返回用户信息，失败返回如下
```html
{
    "data": {
        "errors": "注册失败"
    },
    "code": 1004
}
```