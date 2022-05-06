import mysql.connector
import numpy as np
import array
import random


mydatabase = mysql.connector.connect(
    host = "localhost",
    user = "root",
    passwd = "",
	port = "3306",
    database = "asdf_palace4"
)

check=4000*[None]
flag=0
cursor = mydatabase.cursor()
year=[2020,2021]
month=np.arange(1,13)
day=np.arange(1,24)
hour=np.arange(8,23)
minutes=np.arange(0,60)
seconds=np.arange(0,60)
nfc_id=np.arange(1,1001)
room_id1=np.arange(1,401)
room_id=array.array('i',room_id1)
service_id=[1,2,3,4] #
service_id2=[1,2,3,4,5,6,7]   
amount=np.arange(20,41)
space=np.arange(0,3996)
combinations = [[a, b] for a in nfc_id
          for b in service_id2 if a != b]
for i in range (0,2000):
    y = np.random.choice(year)
    m = np.random.choice(month)
    d = np.random.choice(day)
    h = np.random.choice(hour)
    mi = np.random.choice(minutes)
    sec = np.random.choice(seconds)
    registration_date1 = "-".join([str(y),str(m),str(d)])
    registration_time1 = ":".join([str(h),str(mi),str(sec)])    
    registration_date2 = "-".join([str(y),str(m),str(d+5)])
    registration_time2 = ":".join([str(h),str(mi),str(sec)])
    #useful
    #registration_datetime1 = " ".join([str(registration_date1),str(registration_time1)])
    #registration_datetime2 = " ".join([str(registration_date2),str(registration_time2)])
    #================
    
    c=np.random.choice(space)
    a=combinations[c][0]
    b=combinations[c][1]
    #print(a,b)

    for j in range(0,i):
        if (check[j]==c):
            flag=1
    if (flag==0):
        check[i]=c
    else:
        flag=0
        continue

    if b<5 :
        sql1="""
        INSERT INTO register_to_services (nfc_id,service_id,date_of_registration,time_of_registration) VALUES(%s,%s,%s,%s)"""
        data=(int(a),int(b),registration_date1,registration_time1)
        print (data)
        cursor.execute(sql1,data)
        mydatabase.commit()
    if (b==2):
        room=np.random.choice(room_id)
        room_id.remove(room)
        sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
        data=(int(a),int(room),registration_date1,registration_time1,registration_date2,registration_time2)
        cursor.execute(sql2,data)
        mydatabase.commit()
        
        for j in range (5):
            room=401+j
            sql3="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql3,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'tennis court')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()
            
#         room=440
#         sql4="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
#                 VALUES(%s,%s,%s,%s,%s,%s)"""
#         data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
#         cursor.execute(sql4,data)
#         mydatabase.commit()
        
    elif (b==3):
        for j in range (5):
            room=406+j
            sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql2,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'gym')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()
            
    elif (b==4):
        for j in range (5):
            room=411+j
            sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql2,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'pool')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()
            
    elif (b==5):
        for j in range (10):
            room=416+j
            sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql2,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'conference room')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()

    elif (b==6):
        for j in range (9):
            room=426+j
            sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql2,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'bar/restaurant')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()

    elif (b==7):
        for j in range (6):
            room=435+j
            sql2="""INSERT INTO access (nfc_id,place_id,date_of_start,time_of_start,date_of_end,time_of_end)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            data=(str(a),str(room),registration_date1,registration_time1,registration_date2,registration_time2)
            cursor.execute(sql2,data)
            mydatabase.commit()
            
            sql5="""INSERT INTO visit (nfc_id,place_id,date_of_entrance,time_of_entrance,date_of_exit,time_of_exit)
            VALUES(%s,%s,%s,%s,%s,%s)"""
            day10=np.arange(d,d+5)
            current_day=np.random.choice(day10)
            date="-".join([str(y),str(m+current_day//28),str(current_day%28+1)])
            current_hour=np.random.choice(hour)
            current_minute=np.random.choice(minutes)
            current_second=np.random.choice(seconds)
            time=":".join([str(current_hour),str(current_minute),str(current_second)])
            exit_time=":".join([str(current_hour+2),str(current_minute),str(current_second)])
            #final_date_entrance=" ".join([str(date),str(time)])
            #final_date_exit=" ".join([str(date),str(exit_time)])
            data=(str(a),str(room),date,time,date,exit_time)
            cursor.execute(sql5,data)
            mydatabase.commit()
            
            sql6="""INSERT INTO service_charge (date_of_charge,time_of_charge,amount,description_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(date,exit_time,str(np.random.choice(amount)),'library')
            cursor.execute(sql6,data)
            mydatabase.commit()
            
            sql7="""INSERT INTO receive_services (nfc_id,service_id,date_of_charge,time_of_charge)
            VALUES(%s,%s,%s,%s)"""
            data=(str(a),str(b),date,exit_time)
            cursor.execute(sql7,data)
            mydatabase.commit()

print("done")

 

            
  