from flask import Flask, request, abort,jsonify

import os
import TR

#======這裡是呼叫的檔案內容=====

#======這裡是呼叫的檔案內容=====

#======python的函數庫==========

#======python的函數庫==========

app = Flask(__name__)
static_tmp_path = os.path.join(os.path.dirname(__file__), 'static', 'tmp')



@app.route("/callback", methods=['GET'])
def callback():
   
    return 'OK'


@app.route("/TR", methods=['GET'])
def Tr():
    print(TR.TR())
    return jsonify( TR.TR())




        

if __name__ == "__main__":
    port = int(os.environ.get('PORT', 8000))
    app.run(host='0.0.0.0', port=port)