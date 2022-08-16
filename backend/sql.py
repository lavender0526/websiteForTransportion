from sqlalchemy import create_engine
import pymysql
def main():
    username = 'user'     # 資料庫帳號
    password = '0000'     # 資料庫密碼
    host = '52.139.170.79:3306'    # 資料庫位址
    database = 'trthsr'   # 資料庫名稱
    charset='utf8'
    # 建立連線引擎
    engine = create_engine(f'mysql+pymysql://{username}:{password}@{host}/{database}?charset={charset}')
    con=engine.connect()
    return con
print(main())
