
import urllib.request,json,codecs



from threading import Timer


class perpetualTimer():

   def __init__(self,t,hFunction):
      self.t=t
      self.hFunction = hFunction
      self.thread = Timer(self.t,self.handle_function)

   def handle_function(self):
      self.hFunction()
      self.thread = Timer(self.t,self.handle_function)
      self.thread.start()

   def start(self):
      self.thread.start()

   def cancel(self):
      self.thread.cancel()




regionIndex = 7;
regions = ["euw","na","eune","br","kr","oce","las","lan","ru","tr"]



key = "44477f0d-2008-47e6-b5cf-35ce45905380"
region = regions[regionIndex]
patch = "5.11"
index = 3500;



with open('AP_ITEM_DATASET/' + patch + '/RANKED_SOLO/' + region.upper() + '.json') as data_file:
    matchIdJson = json.load(data_file)




matchid = matchIdJson[index]




def writeData():

    global index
    global patch
    global region
    global key
    global matchid
    global regions
    global regionIndex
    global matchIdJson



    matchid = matchIdJson[index]

    url = "https://" + region + ".api.pvp.net/api/lol/" + region + "/v2.2/match/" + str(matchid) + "?api_key=" + key

    while True:
            try:
                response = urllib.request.urlopen(url)
            except:
              print("retrying : " + str(index))
              continue
            break



    reader = codecs.getreader("utf-8")
    data = json.load(reader(response))
    with open(patch + '-' + region.upper() + '-RANKED/' + str(matchid) + '.json', 'w') as outfile:
        json.dump(data, outfile)

    print(str(index) + " | " + str(region) + " | " + str(matchid))

    index += 1

    if index == 10000:
            index = 0

            regionIndex += 1
            region = regions[regionIndex]
            with open('AP_ITEM_DATASET/' + patch + '/RANKED_SOLO/' + region.upper() + '.json') as data_file:
                matchIdJson = json.load(data_file)
                matchid = matchIdJson[index]



t = perpetualTimer(0.1,writeData)
t.start()



