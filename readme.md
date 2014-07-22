CharactorBirthdayAPI
---

api for any charactor's birthday
アニメ、小説作品などのキャラの誕生日

#request
##GET
###title 作品
* titles
作品のリストをリクエスト

| パラメーター           || 詳細 |
| :-----------    | :---: | :-------------------------------- |
| title\_id       | 任意  | 作品IDの指定 |
| include\_detail  | 任意  | 詳細あり(bool) default: false |
| user\_id        | 任意  | ユーザIDの指定 |

* titles/search
作品名検索でヒットした作品のリストをリクエスト

| パラメーター           || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| q               | 必須  | 絞り込みキーワード |

###cahractor キャラ
* charactors
キャラクターのリストをリクエスト

| パラメーター           || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| charactor\_id   | 任意  | キャラクターidの指定 |
| include\_detail  | 任意  | 詳細あり(bool) default: false |
| user\_id        | 任意  | ユーザIDの指定 |

* charactors/search
キャラクター名検索でヒットしたキャラクターのリストをリクエスト

パラメーター             || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| q               | 必須  | 絞り込みキーワード |

* charactors/date
月や日付指定で該当するキャラクターのリストをリクエスト

|パラメーター            || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| date\_m         | 必須  | 月指定 |
| date\_d         | 任意  | 日指定 |
| user\_id        | 任意  | ユーザIDの指定 |

* charactors/today
当日が誕生日であるキャラクターのリストをリクエスト

|パラメーター            || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| user\_id        | 任意  | ユーザIDの指定 |


#object
charactor include\_detail
```
{
    "id": -1,
    "name": "キャラクター・ネーム",
    "day_m": 12,
    "day_d": 31,
    "title" {
        "id": -1,
        "name": "作品名",
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

title include\_detail
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
