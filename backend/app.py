from flask import Flask, request, abort




#======這裡是呼叫的檔案內容=====

#======這裡是呼叫的檔案內容=====

#======python的函數庫==========

#======python的函數庫==========

app = Flask(__name__)



# 監聽所有來自 /callback 的 Post Request
@app.route("/callback", methods=['POST'])
def callback():
   
    return 'OK'


# 處理訊息
if __name__ == "__main__":

    app.run(host='0.0.0.0', port=8000)