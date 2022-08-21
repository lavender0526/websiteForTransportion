from flask import Flask
import sql
import os
import pandas as pd
import TRprice

app = Flask(__name__)
static_tmp_path = os.path.join(os.path.dirname(__file__), 'static', 'tmp')



@app.route("/callback", methods=['GET'])
def callback():
   
    return 'OK'


@app.route("/TR", methods=['GET'])
def Tr():
    startlocation ='3400'
    endlocation ='4250'
    startnum='永靖'
    endnum='保安'
    con=sql.main()
    response=con.execute(f"SELECT Station,DEPTime,TR.Trainid,chinesename FROM `TR` INNER JOIN (SELECT Trainid FROM `TR` WHERE `Station`={startlocation} OR `Station`={endlocation} GROUP BY `Trainid` HAVING count(*)>1 )  r1 ON r1.`Trainid`=TR.Trainid WHERE `Station`={startlocation} OR `Station`={endlocation}  ORDER BY `TR`.`Trainid`  DESC")
    results = response.fetchall()
    startStation=[ i for i in results if i[0]==startlocation]
    endStation=[ i[1] for i in results if i[0]==endlocation]
    df=pd.DataFrame(startStation)
    df['price']=TRprice.count(startnum,endnum,df['chinesename'])
    concat=pd.concat([df,pd.DataFrame(endStation,columns=['arrival'])],axis=1)
    concat_clear = concat[concat['DEPTime']<concat['arrival']]
    del concat_clear['Station']
    concat_clear = concat_clear.reindex(columns=['Trainid','chinesename','DEPTime','arrival','price']).sort_values('Trainid').to_json(orient = 'records')
    print(concat_clear)
    

    return concat_clear




        

if __name__ == "__main__":
    port = int(os.environ.get('PORT', 8000))
    app.run(host='0.0.0.0', port=port)