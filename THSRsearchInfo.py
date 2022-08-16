#!/usr/bin/env python
# coding: utf-8

# In[8]:


from bs4 import BeautifulSoup
import requests
import json
import datetime
import time
import calendar
import pymysql
from selenium import webdriver
from selenium.webdriver import ActionChains
from selenium.webdriver.support.select import Select
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.common.keys import Keys
import pandas as pd
from flask import Flask, request, render_template


# In[8]:


url = 'https://www.thsrc.com.tw/'
browser = webdriver.Chrome(ChromeDriverManager().install())
browser.get(url)

passAgreebtn = browser.find_element_by_xpath('/html/body/div[5]/div/div[3]/button[2]').click()
status1 = False
status2 = False
stop = ['南港','台北','板橋','桃園','新竹','苗栗','台中','彰化','雲林','嘉義','台南','左營']
stopEng = ['NanGang','TaiPei','BanQiao','TaoYuan','XinZhu','MiaoLi','TaiZhong','ZhangHua','YunLin','JiaYi','TaiNan','ZuoYing']
startStop = Select(browser.find_element_by_id('select_location01'))
endStop = Select(browser.find_element_by_id('select_location02'))
m = browser.find_element_by_xpath('//*[@id="outWardTime"]')

for name in stop:
    if(name == startStop.select_by_visible_text("南港")):
        status1 = True
for name in stop:
    if(name == endStop.select_by_visible_text("台北")):
        status2 = True
m.clear()
m.send_keys('15:00') 


# print(json.loads(request.content))
# if():
    


# In[4]:


df_Seat = pd.read_excel("C:\雲林科技大學\Code\MySql\高鐵票價.xlsx",sheet_name = "對號座")
df_NonSeat = pd.read_excel("C:\雲林科技大學\Code\MySql\高鐵票價.xlsx",sheet_name = "自由座")
print(df_Seat)


# In[5]:


request_North = requests.get('https://quality.data.gov.tw/dq_download_json.php?nid=96937&md5_url=1a31035b9db7de68d841fc0cfaafa1b4')
request_South = requests.get('https://quality.data.gov.tw/dq_download_json.php?nid=96937&md5_url=d9731fca4861ff84299470d731d85e55')
temp_North = pd.DataFrame(json.loads(request_North.content))
temp_South = pd.DataFrame(json.loads(request_South.content))
print(temp_South)


# In[14]:


db_settings = {
    "host": "http://52.139.170.79/phpmyadmin/index.php",
    "user": "user",
    "password": "0000",
    "charset": "utf8"
}
try:
    # 建立Connection物件A
    conn = pymysql.connect(**db_settings)
except Exception as ex:
    print(ex)


# In[ ]:





# In[ ]:




