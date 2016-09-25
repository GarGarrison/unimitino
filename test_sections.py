# 0 1
# 0 2
# 0 3
# 1 4
# 1 5
# 2 6
# 5 7

import MySQLdb
db = MySQLdb.connect(host="localhost", user="root", passwd="12345", db="unimitino", charset='utf8')
cursor = db.cursor()
cursor.execute("select parent, child from subtest")
data = cursor.fetchall()
children = []

tmp = {}

for rec in data:
    p,c = rec
    tmp[p] = tmp.get(p, []) + [c]

print tmp
print tmp.values()
