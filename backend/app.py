

#======python的函數庫==========
import tempfile, os
import datetime
import time
from flask import Flask, request, abort, render_template





app = Flask(__name__,template_folder='templates')
static_tmp_path = os.path.join(os.path.dirname(__file__), 'static', 'tmp')

# 監聽所有來自 /callback 的 Post Request
@app.route("/callback", methods=['GET'])
def callback():
   return 'ok'


# 處理訊息

        
import os
if __name__ == "__main__":
  app.run(host='0.0.0.0',port=8000,debug=True)
