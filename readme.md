CharactorBirthdayAPI
---

api for any charactor's birthday
アニメ、小説作品などのキャラの誕生日

#request
##GET
* title 作品一覧
パラメーター           || 詳細
:-----------    | :---: | :--------------------------------
title\_id       | 任意  | 作品IDを指定する
include\_detil  | 任意  | 詳細あり(bool) default: false
q               | 任意  | キーワード絞り込み

* charactor キャタ一覧
パラメーター          || 詳細
:-----------   | :---: | :--------------------------------
charactor\_id  | 任意  | キャラクターid
include\_detil | 任意  | 詳細あり(bool) default: false
q              | 任意  | キーワード絞り込み
date\_m        | 任意  | 月指定
date\_d        | 任意  | 日指定

    * q (str[null]) 検索絞り込み

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
