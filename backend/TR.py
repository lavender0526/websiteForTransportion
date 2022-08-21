import requests
import json
import pandas as pd
import datetime
import sql
from bs4 import BeautifulSoup

# print(json.loads( request.content))

# for i in pd.bdate_range(start=datetime.datetime.now(),periods=2,freq='D'):
#     date=str(i.date()).replace('-','')
#     request=requests.get(f'http://ods.railway.gov.tw/tra-ods-web/ods/download/dataResource/railway_schedule/JSON/list/{date}.json')
#     print(json.loads(request.content))
response = requests.get("https://ods.railway.gov.tw/tra-ods-web/ods/download/dataResource/railway_schedule/JSON/list")
soup = BeautifulSoup(response.text, "html.parser")
#  https://ods.railway.gov.tw/tra-ods-web/ods/download/dataResource/exceptionDataResource/8ae4c98182629a1f0182841f1e8e3f37

# for i in soup.find_all('a')[0]:
url=(soup.find('a',text='20220824.json').get('href'))
request=requests.get(f'https://ods.railway.gov.tw{url}')
time=json.loads(request.content)
TrainInfos=pd.DataFrame.from_dict(time['TrainInfos'])

del TrainInfos['TimeInfos']
TimeInfos=[]
for train in time['TrainInfos']:
    for train_info in train['TimeInfos']:
        train_info['Trainid']=train['Train']
        if '113' in train['CarClass']:
            train_info['chinesename']='區間'
        elif '111' in train['CarClass']:
            train_info['chinesename']='莒光'
        elif '11' in train['CarClass']:
            train_info['chinesename']='自強'
        TimeInfos.append(train_info)
        

TimeInfos=pd.DataFrame.from_dict(TimeInfos)
print(TimeInfos)

con=sql.main()
# print(con)
TimeInfos.to_sql(name='TR',con=con,if_exists='replace',index=False)




