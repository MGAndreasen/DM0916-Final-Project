


def test1():
    import urllib
    url = "http://4pi.dk/playground/testjsondata/index.php?fbclid=IwAR3NWUErkGsKorzr7omAkj33PcWqrjMFuyLZyUiMiv2A6H5PdATMvt7cH7c";
    req = urllib.request.Request(url, headers={'User-Agent' : "CNNModelCreator"}) 
    con = urllib.request.urlopen(req)
    print(con.read())


#not working
def test2():
    import urllib
    import requests
    import shutil
    url = "http://4pi.dk/playground/testjsondata/index.php?fbclid=IwAR3NWUErkGsKorzr7omAkj33PcWqrjMFuyLZyUiMiv2A6H5PdATMvt7cH7c";
    r = requests.get(settings.STATICMAP_URL.format(url), stream=True)
    if r.status_code == 200:
        with open(path, 'wb') as f:
            r.raw.decode_content = True
            shutil.copyfileobj(r.raw, f) 

def test3():
    import urllib
    fileName = R'C:\test\001.jpg'
    f = open(fileName,'wb')
    f.write(urllib.request.urlopen('http://www.gunnerkrigg.com//comics/00000001.jpg').read())
    f.close()


def deleteAllFilesInFolder():
    import os, shutil
    folder = R'C:\CnnModelCreatorData\bmx'
    for the_file in os.listdir(folder):
        file_path = os.path.join(folder, the_file)
        try:
            if os.path.isfile(file_path):
                os.unlink(file_path)
            #elif os.path.isdir(file_path): shutil.rmtree(file_path)
        except Exception as e:
            print(e)

test3()