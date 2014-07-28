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
| include\_detail | 任意  | 詳細あり(bool) default: false |

* titles/search
作品名検索でヒットした作品のリストをリクエスト

| パラメーター           || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| q               | 必須  | 絞り込みキーワード |
| include\_detail | 任意  | 詳細あり(bool) default: false |

####サンプル
url : http://api.elzup.com/birthday/titles/search.json?q=%E3%83%A2%E3%83%B3%E3%82%B9%E3%82%BF%E3%83%BC&include\_details=1

* titles/user
ユーザのwatchした作品のリストをリクエスト

| パラメーター           || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| user\_id        | 任意  | ユーザIDの指定 |
| user\_name      | 任意  | ユーザIDの指定 |
| include\_detail | 任意  | 詳細あり(bool) default: false |

####サンプル
url : http://api.elzup.com/birthday/titles/user.json?user\_name=elzup&include\_details=1

###cahractor キャラ
* charactors
キャラクターのリストをリクエスト

| パラメーター           || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| charactor\_id   | 任意  | キャラクターidの指定 |
| include\_detail | 任意  | 詳細あり(bool) default: false |

* charactors/search
キャラクター名検索でヒットしたキャラクターのリストをリクエスト

パラメーター             || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| q               | 必須  | 絞り込みキーワード |
| include\_detail | 任意  | 詳細あり(bool) default: false |

####サンプル
url : http://api.elzup.com/birthday/charactors/search.json?q=%E4%BA%AC%E5%AD%90&include\_details=1

* charactors/date
月や日付指定で該当するキャラクターのリストをリクエスト

|パラメーター            || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| date\_m         | 必須  | 月指定 |
| date\_d         | 任意  | 日指定 |
| user\_id        | 任意  | ユーザIDの指定 |
| user\_name      | 任意  | ユーザIDの指定 |
| include\_detail | 任意  | 詳細あり(bool) default: false |

####サンプル
url : http://api.elzup.com/birthday/charactors/date.json?date\_m=1&date\_d=5&include\_details=1

url : http://api.elzup.com/birthday/charactors/date.json?date\_m=7&user\_name=elzup&include\_details=1

* charactors/today
当日が誕生日であるキャラクターのリストをリクエスト

|パラメーター            || 詳細 |
| :-------------- | :---: | :-------------------------------- |
| user\_id        | 任意  | ユーザIDの指定 |
| user\_name      | 任意  | ユーザIDの指定 |
| include\_detail | 任意  | 詳細あり(bool) default: false |
| plus            | 任意  | +n日 |

url : http://api.elzup.com/birthday/charactors/today.json?include\_details=1

url : http://api.elzup.com/birthday/charactors/today.json?include\_details=1&plus=1

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
    "count": 1,
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
}
```
