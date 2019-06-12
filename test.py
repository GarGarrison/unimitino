import requests


test_goods = {
    "action": "create_goods",
    "rid": 1,
    # "num": 5,
    # "address": 5,
    "typonominal": "5XSFDsdf",
    "mark": 5,
    "producer": 5,
    "case": 5,
    "price_retail_usd": 5,
    "price_retail_rub": 5,
    "price_minitrade_usd": 5,
    "price_minitrade_rub": 5,
    "price_trade_rub": 5,
    "price_trade_usd": 5,
    "packcount": 5,
    "price_pack_usd": 5,
    "price_pack_rub": 5,
    "onlinecount": 5,
    "offlinecount": 5,
    "cell": 5,
    "description": "very good",
    "description_long": "dfdfgsdfg sdfgsdfg sdfgsfdg sdfgsdfgsdfgsd fsdfgs dfg sdgsdfg sdfg ",
    "new": 1,
    "supply": 5
    # "img": 5
}

test_news = {
    "action": "create_news",
    "title": "olololoo",
    "annotation": "olololo",
    "text": "olololo",
    "important": 1,
    "news_date": "2019-06-15 21:00:00",
    "public_date": "2019-06-20 21:00:00",
    "unpublic_date": "2019-07-01 21:00:00"
}

# test create goods
# try:
#     req = requests.post("http://localhost:8000/backoffice", data = test_goods)
#     assert req.status_code == 200, "status is'not 200"
#     assert req.text.isdigit, "response is not int"
# except Exception as e:
#     print(str(e))
#     print("status: ", req.status_code)
#     print("text: ", req.text)

# test delete goods
try:
    req = requests.post("http://localhost:8000/backoffice", data = {"action": "delete_goods", "id": 76353})
    req = requests.post("http://localhost:8000/backoffice", data = {"action": "delete_goods", "id": 76354})
    assert req.status_code == 200, "status is not 200"
    assert req.text == "ok", "response is not ok"
except Exception as e:
    print(str(e))
    print("status: ", req.status_code)
    print("text: ", req.text)