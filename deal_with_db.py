# 0 1
# 0 2
# 0 3
# 1 4
# 1 5
# 2 6
# 5 7

import MySQLdb
db = MySQLdb.connect(host="devzone.ru", user="user", passwd="Chacheihu4", db="unimitino", charset='utf8')
cursor = db.cursor()
cursor.execute("select * from rubric_relations")
data = cursor.fetchall()

for rec in data:
    rid = rec[0]
    relation = rec[1]
    parent = "0"
    if len(relation.split("#")) > 1:
        parent = relation.split("#")[-2]
    sql = "update rubric_relations set relation={0} where rid={1}".format(parent, rid)
    # print(sql)
    cursor.execute(sql)

db.commit()
db.close()
