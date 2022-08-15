from flask import Flask, request, abort

import os


#======這裡是呼叫的檔案內容=====

#======這裡是呼叫的檔案內容=====

#======python的函數庫==========

#======python的函數庫==========

app = Flask(__name__)
static_tmp_path = os.path.join(os.path.dirname(__file__), 'static', 'tmp')


# 監聽所有來自 /callback 的 Post Request
@app.route("/callback", methods=['POST'])
def callback():
   
    return 'OK'


# 處理訊息

        

if __name__ == "__main__":
    port = int(os.environ.get('PORT', 8000))
    app.run(host='0.0.0.0', port=port)