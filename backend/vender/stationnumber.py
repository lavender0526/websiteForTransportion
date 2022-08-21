import requests
from bs4 import BeautifulSoup
import pandas as pd
import sql
response = requests.get("https://www.railway.gov.tw/tra-tip-web/tip/tip001/tip111/view")
soup = BeautifulSoup(response.text, "html.parser")
name=[ i.text for i in soup.find_all("div",{'class':'traincode_name1'})]
code=[ i.text for i in soup.find_all("div",{'class':'traincode_code1'})]
stationnumber=pd.DataFrame({'name':name,'number':code})
print(stationnumber)
con=sql.main()
# print(con)
stationnumber.to_sql(name='stationnumber',con=con,if_exists='replace',index=False)