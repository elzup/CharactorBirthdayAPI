CharactorBirthdayAPI
---

api for any charactor's birthday
アニメ、小説作品などのキャラの誕生日

#request
##GET
* title
    作品一覧
* charactor
    キャラクタ一覧

#object
charactor is\_detail
```
{
    "id": -1,
    "name": "キャラクター・ネーム",
    "day_m": 12,
    "day_d": 31,
    "title" {
        "id": -1,
        "name": "作品名",
        "charactor_count": 1
    }
}
```

charactor
```
{
    "id": -1,
    "name": "キャラクター・ネーム",
    "day_m": 12,
    "day_d": 31
}
```

title is\_detail
```
{
    "id": -1,
    "name": "作品名",
    "charactor_count": 1,
    "charactors": [
        {
            "id": -1,
            "name": "キャラクター・ネーム",
            "day_m": 12,
            "day_d": 31
        }
    ]
}
```

title
```
{
    "id": -1,
    "name": "作品名",
    "charactor_count": 1
}
```
