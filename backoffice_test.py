import requests

test_base = {
    "secret": "ceiFa2aequaezairaiPhiewae4ahgeem7ra9eegha5Ee5yah6ohchah9yaeth7ji"
}

data = {"action": "get_orders_updated_after", "after": "2019-07-01 00:00:00"}
data.update(test_base)
req = requests.post("http://localhost:8000/backoffice", data = data)
print(req.status_code)
print(req.text)