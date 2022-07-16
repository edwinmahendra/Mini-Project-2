def getResult(kp, das, kl, kw, ch):
    kepadatan_penduduk = ''
    daerah_sungai = ''
    kemiringan_lereng = ''
    ketinggian_wilayah = ''
    curah_hujan = ''

    temp = {}
#parameter kepadatan penduduk
    if kp >= 1 and kp <= 500:
        kepadatan_penduduk = 'tidak padat'

    elif kp > 500:
        kepadatan_penduduk = 'padat'

#parameter daerah aliran sungai
    if das >= 1 and das < 90000 :
        daerah_sungai = "kecil"
    elif das >= 90000 and das < 500000:
        daerah_sungai = "sedang"
    elif das > 500000 :
        daerah_sungai = "besar"

#parameter kemiringan lereng
    if kl >= 0 and kl <= 15 :
        kemiringan_lereng = "landai"
    elif kl >= 16 and kl <= 40 :
        kemiringan_lereng = "curam"
    elif kl > 40 :
        kemiringan_lereng = "sangat curam"

#parameter ketinggian wilayah
    if kw < 175 :
        ketinggian_wilayah = "rendah"
    elif kw >= 175 and kw <= 300 :
        ketinggian_wilayah = "sedang"
    elif kw > 300 :
        ketinggian_wilayah = "tinggi"

#parameter curah hujan
    if ch < 20 :
        curah_hujan = "rendah"
    elif ch >= 20 and ch <= 90 :
        curah_hujan = "sedang"
    elif ch > 90:
        curah_hujan = "tinggi"

    
    getConclusion(kepadatan_penduduk, daerah_sungai, kemiringan_lereng, ketinggian_wilayah, curah_hujan)

# Press the green button in the gutter to run the script.
if __name__ == '__main__':
    kp = 800
    das = 90000
    kl = 20
    kw = 180
    ch = 21
    getResult(kp, das, kl, kw, ch)