# API v1.0.0

## Table Of Contents

1. [Registration](#registration) 
2. [Authorization](#authorization) 
3. [Logout](#logout) 
4. [Add User Bookmark](#add-user-bookmark) 
5. [Delete User Bookmark](#delete-user-bookmark) 
6. [Get User Bookmarks](#get-user-bookmarks) 
7. [Add Spectacle](#add-spectacle) 
8. [Update Spectacle](#update-spectacle) 
9. [Get Spectacle](#get-spectacle)
10. [Get Spectacles](#get-spectacles) 
11. [Delete Spectacle](#delete-spectacle) 
12. [Add Event](#add-event)
13. [Update Event](#update-event) 
14. [Get Event](#get-event)
15. [Delete Event](#delete-event) 
16. [Add Theater](#add-theater) 
17. [Update Theater](#update-theater) 
18. [Get Theater](#get-theater) 
19. [Get Theaters](#get-theaters) 
20. [Delete Theater](#delete-theater) 
21. [Add Social Network](#add-social-network) 
22. [Update Social Network](#update-social-social)
23. [Get Social Network](#get-social-social) 
24. [Get All Social Networks](#get-all-social-networks)
25. [Delete Social Network](#delete-social-social) 
26. [Add Hall](#add-hall) 
27. [Update Hall](#update-hall) 
28. [Get Hall](#get-hall)
29. [Get Theater Halls](#get-theater-halls)
30. [Delete Hall](#delete-hall) 
31. [Upload Theater Logo](#upload-theater-logo) 
32. [Upload Theater Preview](#upload-theater-logo) 
33. [Upload Spectacle Poster](#upload-spectacle-poster) 
34. [Upload Spectacle Preview](#upload-spectacle-preview) 
35. [Upload Spectacle Slider Poster](#upload-spectacle-sliderposter) 
36. [Upload Theater Photo](#upload-theater-photo) 
37. [Upload Hall Scheme](#upload-hall-scheme) 
38. [Get User Info by Token](#get-user-info-by-token) 
39. [Get All Event](#get-all-events)

BASE_URL  http://host1813162.hostland.pro/api

## Registration

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/register 	|
| error types    	| EmailError          |

#### REQUEST DATA

```json
{
    "email": "example@mail.com",
    "name": "Ivan",
    "surname": "Ivanov",
    "password": "somepassword",
    "password_confirmation": "somepassword",
}
```
#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Регистрация прошла успешно. Вы были перенаправлены на страницу авторизации.",
}
```

#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
    "message": "Указанные данные введены неверно.",
    "errors": {
        "email": [
            "Пользователь с таким email уже зарегистрирован."
        ],
        "password": [
            "Поле пароль не совпадает с полем подтверждения."
        ]
    }
}
```

## Authorization

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/login    	|
| error types    	| EmailError, PasswordError|

#### REQUEST DATA

```json
{
    "email": "example@mail.com",
    "password": "userpassword"
}
```
#### RESPONSE DATA [SUCCESS]


```json
{
     
     
    "token": "access_token_here",
    "user": {
        "id": 67,
        "email": "example@mail.com",
        "name": "Ivan",
        "surname": "Ivanov"
    }
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
    "message": "Не удаётся войти. Неверный логин или пароль."
}
```

## Logout

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/logout    	|
| required headers  | Authorization         |

>*Note*: Формально логаут это удаление токена, т.е. никакие дополнительные данные не нужны. Токен будет в приведенном хэдере запроса. 

#### RESPONSE DATA [SUCCESS]

```json
{ 
    "message": "Вы успешно вышли из системы.",
}
```
## Add User Bookmark

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/bookmark?user_id={user_id}&spectacle_id={spectacle_id}|
| error types    	| UserNotFound, SpectacleNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "spectacle_id": "spectacle_id_to_bookmark",
    "user_id": "user_id_to_bookmark"
}
```
#### RESPONSE DATA [SUCCESS]

```json
{  
    "message": "Спектакль добавлен в закладки",
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
    "message": "Указанные данные введены неверно.",
    "errors": {
        "type": [
            "Пользователь с таким ID пользователя не найден."
        ],
        "spectacle_id": [
            "Спектакль с таким ID не найден."
        ],
        "permission": [
            "Отказано в доступе."
        ]
    }
}
```
## Delete User Bookmark

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/bookmark?id={bookmark_id}|
| error types    	| UserNotFound, BookmarkNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{  
    "message": "Закладка удалена",
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
    "message": "Указанные данные введены неверно.",
    "errors": 
        {
            "type": "BookmarkNotFound",
            "message": "Закладка пользователя с таким ID не найдена."
        },
        {
            "type": "PermissionDenied"
            "message": "Отказано в доступе."
        ]
    }
}
```

## Get User Bookmarks

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/bookmarks?user_id={user_id}|
| error types    	| UserNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются все закладки пользователя. В примере ответа от сервера приведено 2. 2) Если заметок нет, соответственно, bookmarks будет пустым списком.

```json
{    
    "bookmarks": [
        {
            "spectacle_id": "id_of_bookmarked_spectacle_1",
            "name": "spectacle_name_1",
            "description": "spectacle_description_1",
            "rate": "spectacle_rate_1",
            "poster": "spectacle_poster_1",
            "theater_id": "theater_id_1"
        },
        {
            "spectacle_id": "id_of_bookmarked_spectacle_2",
            "name": "spectacle_name_2",
            "description": "spectacle_description_2",
            "rate": "spectacle_rate_2",
            "poster": "spectacle_poster_2",
            "theater_id": "theater_id_2"
        }
    ]
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{   
    "errors": [
        {
            "type": "UserNotFound",
            "message": "Пользователь с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе получения информации о закладках пользователя возникли ошибки."
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{  
    "errors": [
        {
            "type": "UserNotFound",
            "message": "Пользователь с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе получения информации о истории платежей пользователя возникли ошибки."
}
```

## Add Spectacle

[<-- Back to Table Of Contents](#table-of-contents)

UPDATED

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/spectacle|
| error types    	| TheaterNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "spectacle_name",
    "description": "spectacle_description",
    "rate": 0,
    "duration": 90,
    "year": 2019,
    "poster": "spectacle_poster",
    "trailer": "spectacle_trailer",
    "slider_poster": "spectacle_slider_poster",
    "theater_id": "theater_id"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{    
    "spectacle": {
        "id": 255,
    },
    "message": "Спектакль успешно добавлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{   
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе добавления спектакля возникли ошибки."
}
```

## Update Spectacle

[<-- Back to Table Of Contents](#table-of-contents)

UPDATED

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| PATCH |
| route          	| BASE_URL/spectacle?id={spectacle_id}|
| error types    	| SpectacleNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "new_spectacle_name",
    "description": "new_spectacle_description",
    "rate": 0,
    "duration": 90,
    "year": 2019,
    "poster": "new_spectacle_poster",
    "trailer": "new_spectacle_trailer",
    "slider_poster": "new_spectacle_slider_poster"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{    
    "message": "Спектакль успешно обновлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{   
    "errors": [
        {
            "type": "SpectacleNotFound",
            "message": "Спектакль с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе обновления спектакля возникли ошибки."
}
```

## Get Spectacle

[<-- Back to Table Of Contents](#table-of-contents)

UPDATED

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/spectacle?id={spectacle_id}|
| error types    	| SpectacleNotFound |

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются спектакль c id == spectacle_id.

```json
{  
    "spectacle": {
        "name": "spectacle_name",
        "description": "spectacle_description",
        "rate": 4.7,
        "duration": 90,
        "year": 2019,
        "poster": "spectacle_poster",
        "slider_poster": "spectacle_slider_poster",
        "theater_id": "theater_id"
    }
}
```

#### RESPONSE DATA [FAIL]

```json
{
    "errors": [
        {
            "type": "SpectacleNotFound",
            "message": "Спектакль с таким id не найден."
        }
    ],
    "message": "В процессе получения информации о спектакле возникли ошибки."
}
```

## Get Spectacles

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/spectacles?theater_id={theater_id}|
| error types    	| TheaterNotFound, PermissionDenied|

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются все спектакли с трибутом id театра == theater_id. В примере ответа от сервера приведено 2 результата. 2) Если спектаклей нет, spectacles будет пустым списком.

```json
{
    "spectacles": [
        {
            "id": 1,
            "name": "spectacle_name_1",
            "rate": 4.7,
            "poster": "spectacle_poster_1"
        },
        {
            "id": 2,
            "name": "spectacle_name_2",
            "rate": 4.1,
            "poster": "spectacle_poster_2"
        },
    ]
}
```

#### RESPONSE DATA [FAIL]

```json
{
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        }
    ],
    "message": "В процессе получения информации о спектаклях театра возникли ошибки."
}
```

## Delete Spectacle

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/spectacle?id={spectacle_id}|
| error types    	| SpectacleNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Спектакль успешно удален",
}
```
#### RESPONSE DATA [FAIL]

```json
{  
    "errors": [
        {
            "type": "SpectacleNotFound",
            "message": "Спектакль с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе удаления спектакля возникли ошибки."
}
```

## Add Event

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/event?theater_id={theater_id}&spectacle_id={spectacle_id}&hall_id={hall_id}|
| error types    	| SpectacleNotFound, HallNotFound, TheaterNotFound, PermissionDenied |
| required headers  | Authorization         |

1) Данные по атрибутам 'is_premiere', 'is_chosen_for_main_page' принимаются в формате boolean, где false = 0, а true = 1
2) Формат для даты - 2020-12-30 24:59:59

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "dated_at": "event_date",
    "available_seats_number": 145,
    "hall_id": "event_hall_id",
    "theater_id": "event_theater_id",
    "spectacle_id": "event_spectacle_id"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{  
    "event": {
        "id": 255,
    },
    "message": "Событие успешно добавлено."
}
```

#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки; 2) Перечислены все возможные ошибки.

```json
{   
    "errors": [
        {
            "type": "SpectacleNotFound",
            "message": "Спектакль с таким id не найден."
        },
        {
            "type": "HallNotFound",
            "message": "Зал с таким id не найден."
        },
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе добавления события возникли ошибки."
}
```

## Update Event

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| PATCH |
| route          	| BASE_URL/event?id={event_id}|
| error types    	| EventNotFound, SpectacleNotFound, HallNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "dated_at": "new_event_date",
    "available_seats_number": 234,
    "spectacle_id": 12,
    "hall_id": 1,
    "theater_id": 2,
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Событие успешно обновлено."
}
```

#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки; 2) Перечислены все возможные ошибки.

```json
{
     
    "errors": [
        {
            "type": "EventNotFound",
            "message": "Событие с таким id не найдено."
        },
        {
            "type": "SpectacleNotFound",
            "message": "Спектакль с таким id не найден."
        },
        {
            "type": "HallNotFound",
            "message": "Зал с таким id не найден."
        },
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе обновления информации о событии возникли ошибки."
}
```

## Get Event

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/event?id={event_id}|
| error types    	| EventNotFound |

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются событие c id == event_id.

```json
{
     
     
    "event": {
        "dated_at": "event_date",
        "available_seats_number": 145,
        "spectacle_id": 25,
        "hall_id": 2,
        "theater_id": 3
    }
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "EventNotFound",
            "message": "Событие с таким id не найдено."
        }
    ],
    "message": "В процессе получения информации о событии возникли ошибки."
}
```

## Delete Event

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/event?={event_id}|
| error types    	| EventNotFound, Permission Denied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Событие успешно удалено",
}
```
#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "EventNotFound",
            "message": "Событие с таким id не найдено."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе удаления события возникли ошибки."
}
```
## Add Theater

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/theater|
| error types    	| PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "theater_name",
    "description": "theater_description"
    "address": "theater_address",
    "logo": "theater_logo",
    "photo": "theater_photo",
    "preview": "theater_preview",
    "cash_desk_phone_number": "theater_cash_desk_phone_number",
    "phone_number_for_reference": "theater_phone_number_for_reference",
    "contacts": "theater_contacts"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "theater": {
        "id": 255,
    },
    "message": "Театр успешно добавлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{   
    "errors": [
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе добавления нового театра возникли ошибки."
}
```

## Update Theater

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| PATCH |
| route          	| BASE_URL/theater?id={theater_id}|
| error types    	| TheaterNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "new_theater_name",
    "description": "new_theater_description"
    "address": "new_theater_address",
    "logo": "new_theater_logo",
    "photo": "new_theater_photo",
    "preview": "new_theater_preview",
    "cash_desk_phone_number": "new_theater_cash_desk_phone_number",
    "phone_number_for_reference": "new_theater_phone_number_for_reference",
    "contacts": "theater_contacts"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Театр успешно обновлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе обновления информации о театре возникли ошибки."
}
```

## Get Theater

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/theater?id={theater_id}|
| error types    	| TheaterNotFound |

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются театр c id == theater_id.

```json
{
     
     
    "theater": {
            "id": 1,
            "name": "theater_name_1",
            "description": "theater_description_1"
            "address": "theater_address_1",
            "logo": "theater_logo_1",
            "photo": "theater_photo_1"
            "cash_desk_phone_number": "theater_cash_desk_phone_number_1",
            "phone_number_for_reference": "theater_phone_number_for_reference_1"
        }
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        }
    ],
    "message": "В процессе получения информации о театре возникли ошибки."
}
```

## Get Theaters

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/theaters|
| error types    	| |

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются все театры. В примере ответа от сервера приведено 2 результата. 2) Если театров нет, theaters будет пустым списком.

```json
{
     
     
    "theaters": [
        {
            "id": 1,
            "name": "theater_name_1",
            "description": "theater_description_1"
            "address": "theater_address_1",
            "logo": "theater_logo_1",
            "photo": "theater_photo_1"
            "cash_desk_phone_number": "theater_cash_desk_phone_number_1",
            "phone_number_for_reference": "theater_phone_number_for_reference_1"
        },
        {
            "id": 2,
            "name": "theater_name_2",
            "description": "theater_description_2"
            "address": "theater_address_2",
            "logo": "theater_logo_2",
            "photo": "theater_photo_2"
            "cash_desk_phone_number": "theater_cash_desk_phone_number_2",
            "phone_number_for_reference": "theater_phone_number_for_reference_2"
        },
    ]
}
```

## Delete Theater

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/theater?={theater_id}|
| error types    	| TheaterNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{     
    "message": "Театр успешно удален",
}
```
#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе удаления театра возникли ошибки."
}
```

## Add Social Network

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/socialnetwork|
| error types    	| PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "social_network_name",
    "logo": "social_network_logo",
    "url": "social_network_url",
    "theater_id": "theater_id"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "social_network": {
        "id": 255,
    },
    "message": "Социальная сеть успешно добавлена."
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе добавления социальной сети возникли ошибки."
}
```

## Update Social Network

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| PATCH |
| route          	| BASE_URL/socialnetwork?id={social_network_id}|
| error types    	| SocialNetworkNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "new_social_network_name",
    "logo": "new_social_network_logo",
    "url": "new_social_network_url",
    "theater_id": "new_social_network_theater_id"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Социальная сеть успешно обновлена."
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "SocialNetworkNotFound",
            "message": "Социальная сеть с таким id не найдена."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе обновления социальной сети возникли ошибки."
}
```

## Get Social Network

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/socialnetworks?id={social_network_id}|
| error types    	| SocialNetworkNotFound |

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются социальная сеть c id == social_network_id.

```json
{
     
     
    "social_network": {
    "name": "social_network_name",
    "logo": "social_network_logo",
    "url": "social_network_url",
    "theater_id": "social_network_theater_id"
    }
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "SocialNetworkNotFound",
            "message": "Социальная сеть с таким id не найдена."
        }
    ],
    "message": "В процессе получения информации о социальной сети возникли ошибки."
}
```
## Get All Social Networks

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/socialnetworks|
| error types    	| SocialNetworkNotFound |

#### RESPONSE DATA [SUCCESS]


```json
{
     
     
    "social_networks": {
      "name": "social_network_name",
      "logo": "social_network_logo",
      "url": "social_network_url",
      "theater_id": "social_network_theater_id"
    },
    {
      "name": "social_network_name",
      "logo": "social_network_logo",
      "url": "social_network_url",
      "theater_id": "social_network_theater_id"
    }
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "SocialNetworkNotFound",
            "message": "Социальная сеть с таким id не найдена."
        }
    ],
    "message": "В процессе получения информации о социальной сети возникли ошибки."
}
```

## Delete Social Network

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/socialnetwork?id={social_network_id}|
| error types    	| SocialNetworkNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Социальная сеть успешно удалена",
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "SocialNetworkNotFound",
            "message": "Социальная сеть с таким id не найдена."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе удаления социальной сети возникли ошибки."
}
```
## Add Hall

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST |
| route          	| BASE_URL/hall?theater_id={theater_id}|
| error types    	| TheaterNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "hall_name",
    "scheme": "hall_scheme"
    "capacity": 156,
    "theater_id": "theater_id"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "hall": {
        "id": 34
    }
    "message": "Зал успешно добавлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе добавления зала возникли ошибки."
}
```

## Update Hall

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| PATCH |
| route          	| BASE_URL/hall?id={hall_id}|
| error types    	| HallNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### REQUEST DATA

```json
{
    "name": "new_hall_name",
    "scheme": "new_hall_scheme"
    "capacity": 156
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Зал успешно обновлен."
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        },
        {
            "type": "HallNotFound",
            "message": "Зал с таким id не найден."
        }
    ],
    "message": "В процессе обновления информации о зале возникли ошибки."
}
```

## Get Hall

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/hall?id={hall_id}|
| error types    	| HallNotFound |

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "hall": {
        "id": 89,
        "name": "hall_name",
        "scheme": "hall_scheme"
        "capacity": 156,
        "theater_id": "theater_id"
    }
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "HallNotFound",
            "message": "Зал с таким id не найден."
        }
    ],
    "message": "В процессе получения информации о зале возникли ошибки."
}
```

## Get Theater Halls

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/halls?theater_id={theater_id}|
| error types    	| TheaterNotFound, PermissionDenied|

#### RESPONSE DATA [SUCCESS]

>*Note*: 1) Возвращаются все залы с трибутом id театра == theater_id. В примере ответа от сервера приведено 2 результата. 2) Если залов нет, halls будет пустым списком.

```json
{
     
     
    "halls": [
        {
            "id": 89,
            "name": "hall_name_1",
            "scheme": "hall_scheme_1"
            "capacity": 313,
            "theater_id": "theater_id_1"
        },
        {
            "id": 123,
            "name": "hall_name_2",
            "scheme": "hall_scheme_2"
            "capacity": 123,
            "theater_id": "theater_id_2"
        } 
    ]
}
```

#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        }
    ],
    "message": "В процессе получения информации о залах театра возникли ошибки."
}
```

## Delete Hall

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| DELETE |
| route          	| BASE_URL/hall?id={hall_id}|
| error types    	| HallNotFound, PermissionDenied |
| required headers  | Authorization         |

>*Note*: PermissionDenied - ошибка проверки токена доступа, который лежит в хэдере Authorization (для неавторизованных пользователей выполнение операции невозможно).

#### RESPONSE DATA [SUCCESS]

```json
{
     
     
    "message": "Зал успешно удален",
}
```
#### RESPONSE DATA [FAIL]

```json
{
     
    "errors": [
        {
            "type": "HallNotFound",
            "message": "Зал с таким id не найден."
        },
        {
            "type": "PermissionDenied",
            "message": "Отказано в доступе."
        }
    ],
    "message": "В процессе удаления зала возникли ошибки."
}
```

## Upload Theater Logo

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/theater/logo    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "theater_logo": "theater_logo_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```

## Upload Theater Preview

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/theater/preview    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "theater_preview": "theater_preview_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```

## Upload Spectacle Poster

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/spectacle/poster    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "spectacle_poster": "spectacle_poster_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```

## Upload Spectacle Preview

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/spectacle/preview   	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "spectacle_preview": "spectacle_preview_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```

## Upload Spectacle Silder Poster

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/spectacle/slider-poster    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "spectacle_sliderposter": "spectacle_sliderposter_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```
## Upload Theater Photo

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/theater/photo    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "theater_photo": "theater_photo_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```
## Upload Hall Scheme

[<-- Back to Table Of Contents](#table-of-contents)

|attribute          |value         	        |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/file/hall/scheme    	|
| required headers  | Authorization         |

#### REQUEST DATA


```json
{
    "hall_scheme": "hall_scheme_image.png"
}
```

#### RESPONSE DATA [SUCCESS]

```json
{
    "message": "Картинка успешно загружена на сервер по адресу:",
    "url": "URL_PHOTO",
}
```

## Get User Info By Token

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| POST              	|
| route          	| BASE_URL/user    	|
| error types    	| EmailError, PasswordError|
| required headers | Authorization* |

*Authorization token - type Bearer.

#### REQUEST DATA

```json
{
    Authorization Token only.
}
```
#### RESPONSE DATA [SUCCESS]


```json
{
     
     
    "user": {
    "id": "id",
    "name": "name",
    "surname": "surname",
    "email": "example@mail.com",
    "password": "userpassword",
    "role": "user_role",
    "theater_id": "theater_id_moder"
    }
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
    "message": "Unauthenticated."
}
```
## Get All Events

[<-- Back to Table Of Contents](#table-of-contents)

|attribute        |value         	      |
|----------------	|-------------------	|
| request method 	| GET |
| route          	| BASE_URL/allevents|
| error types    	| TheaterNotFound|

#### RESPONSE DATA [SUCCESS]

```json
{
    "events": [
        {
            "id": "event_id_1",
            "dated_at": "event_date_1",
            "theater_id": "event.theater_id_1",
            "spectacle_id": "event.spectacle_id_1",
            "hall_id": "event.hall_id_1",
            "available_seats_number": "available_seats_number_1",
            "spectacle": {
                "id": "spectacle_id_1",
                "name": "spectacle_name_1",
                "description": "spectacle_name_1",
                "slider_poster": "spectacle_slider_poster_1",
                "rate": "spectacle_rate_1",
                "year": "spectacle_year_1",
                "poster": "spectacle_poster_1",
                "trailer": "spectacle_trailer_1",
                "slider_poster": "spectacle_slider_poster_1",
                "theater_id": "theater_id_1",
            },
            "theater": {
                "id": "theater_id_1",
                "name": "theater_name_1",
                "logo": "theater_logo_1",
                "description": "theater_description_1",
                "address": "theater_address_1",
                "photo": "theater_photo_1",
                "preview": "theater_preview_1",
                "cash_desk_phone_number": "theater_cash_desk_phone_number_1"
                "phone_number_for_reference": "theater_phone_number_for_reference_1"
            },
        },
        {
                "id": "event_id_2",
                "dated_at": "event_date_2",
                "theater_id": "event.theater_id_2",
                "spectacle_id": "event.spectacle_id_2",
                "hall_id": "event.hall_id_2",
                "available_seats_number": "available_seats_number_2",
            },
            "spectacle": {
                "id": "spectacle_id_2",
                "name": "spectacle_name_2",
                "description": "spectacle_name_2",
                "slider_poster": "spectacle_slider_poster_2",
                "rate": "spectacle_rate_2",
                "year": "spectacle_year_2",
                "poster": "spectacle_poster_2",
                "trailer": "spectacle_trailer_2",
                "slider_poster": "spectacle_slider_poster_2",
                "theater_id": "theater_id_2",
            },
            "theater": {
                "id": "theater_id_2",
                "name": "theater_name_2",
                "logo": "theater_logo_2",
                "description": "theater_description_2",
                "address": "theater_address_2",
                "photo": "theater_photo_2",
                "preview": "theater_preview_2",
                "cash_desk_phone_number": "theater_cash_desk_phone_number_2"
                "phone_number_for_reference": "theater_phone_number_for_reference_2"
            },
        },
    ]
}
```
#### RESPONSE DATA [FAIL]

>*Note*: 1) Возвращаются только найденные ошибки

```json
{
     
    "errors": [
        {
            "type": "TheaterNotFound",
            "message": "Театр с таким id не найден."
        },
    ],
    "message": "В процессе получения информации о событиях возникли ошибки."
}
```
