import requests

test_base = {
    "secret": "ceiFa2aequaezairaiPhiewae4ahgeem7ra9eegha5Ee5yah6ohchah9yaeth7ji"
}

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
    "description": "очень хороший товар",
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


def test_create_delete_goods():
    # test create goods
    DELETE_ID = 0
    test_goods.update(test_base)
    req = requests.post("http://localhost:8000/backoffice", data = test_goods)
    try:
        assert req.status_code == 200, "status is'not 200"
        assert req.text.isdigit, "response is not int"
        DELETE_ID = int(req.text)
        print("Successfully create goods with id={}".format(DELETE_ID))
    except Exception as e:
        print(str(e))
        print("status: ", req.status_code)
        print("text: ", req.text)

    # test delete goods
    if DELETE_ID != 0:
        data = {"action": "delete_goods", "id": DELETE_ID}
        data.update(test_base)
        req = requests.post("http://localhost:8000/backoffice", data = data)
        try:
            assert req.status_code == 200, "status is not 200"
            assert req.text == "ok", "response is not ok"
            print("Successfully delete goods with id={}".format(DELETE_ID))
        except Exception as e:
            print(str(e))
            print("status: ", req.status_code)
            print("text: ", req.text)

def test_update_user():
    #test update user
    uid = "04197004-f692-4093-959f-c8a16dbf7d67"
    data = {"action": "update_user", "id": uid, "address":"Королев Богомолова"}
    data.update(test_base)
    req = requests.post("http://localhost:8000/backoffice", data = data)
    try:
        assert req.status_code == 200, "status is not 200"
        assert req.text == "ok", "response is not ok"
        print("Successfully update user with id={}".format(uid))
    except Exception as e:
        print(str(e))
        print("status: ", req.status_code)
        print("text: ", req.text)

def test_get_user_uuid():
    email = "q@q.ru"
    data = {"action": "get_user_uid_by_email", "email": email}
    data.update(test_base)
    req = requests.post("http://localhost:8000/backoffice", data = data)
    try:
        assert req.status_code == 200, "status is not 200"
        print("Successfully get user uid={} for email={}".format(req.text, email))
    except Exception as e:
        print(str(e))
        print("status: ", req.status_code)
        print("text: ", req.text)

test_get_user_uuid()