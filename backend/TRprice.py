import requests
import json
import pandas as pd
import datetime
import numpy as np
import time

from bs4 import BeautifulSoup
from selenium import webdriver
from selenium.webdriver.support.ui import Select
startArea='高雄地區'
startLocation='大湖'
endArea='彰化地區'
endLocation='彰化'
options = webdriver.ChromeOptions()
options.add_argument("headless")
browser = webdriver.Chrome(executable_path='./chromedriver',options=options)
browser.get("https://nicky.tw/tra/")
startAreaselect = Select(browser.find_element('xpath','/html/body/form[1]/select[1]'))
startAreaselect.select_by_visible_text(startArea)
startLocationselect = Select(browser.find_element('xpath','/html/body/form[1]/select[2]'))
startLocationselect.select_by_visible_text(startLocation)
endAreaselect = Select(browser.find_element('xpath','/html/body/form[2]/select[1]'))
endAreaselect.select_by_visible_text(endArea)
endLocationselect = Select(browser.find_element('xpath','/html/body/form[2]/select[2]'))
endLocationselect.select_by_visible_text(endLocation)
browser.find_element('xpath',"/html/body/input[1]").click()
soup = BeautifulSoup(browser.page_source, 'html.parser')

price=[]
for i in soup.find_all('td'):
   
    price.append(i.text.replace(':','').replace('元',''))
dict=dict(zip([i for i in price[::2]],[i for i in price[1::2]]))
print(dict)


# time.sleep(69)
#  https://ods.railway.gov.tw/tra-ods-web/ods/download/dataResource/exceptionDataResource/8ae4c98182629a1f0182841f1e8e3f37

# for i in soup:
#     url=(i.get('href'))
#     request=requests.get(f'https://ods.railway.gov.tw{url}')
