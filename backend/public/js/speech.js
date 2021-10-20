const speechYandexRU = new Vue({
    el: '#yandexRu',

    data: {
      text:'',
      voice:'',
      speed: '',
      emotion: '',
      audio:'',
      interval:'',
      it:null
 
    },
    methods: {

      async Audio(data){
        this.interval =  await setInterval(  () => {
          if(this.audio.length<=0){
        axios.post('/api/yandex/check',{'audio':data}).then(((response=>{
          if(response.data==1){
            this.audio = data
            clearInterval(this.interval )
          }
        } 
       
                  
              
        )))

          }else{
            clearInterval(this.interval )
          }
          
         
          
      }, 1000);
       
       
      },
        async Yandex(){
          if(this.text&&this.voice&&this.speed&&this.emotion){
            let speech = {
                voice: this.voice,
                text: this.text,
                speed: this.speed,
                emotion: this.emotion,
                lang:'ru-RU'
            }
            clearInterval(this.interval )
            this.audio = ''
            console.log(speech)
            await axios.post('http://speech.local/api/yandex',speech).then(((  response => {
                if(response.data && !this.audio.length){
                 
                    this.Audio(response.data) 
                  
                    
              
                        
                      }
                })))
          }
        }
   
    },
    beforeDestroy(){
      clearInterval(this.interval )
 }
    
  });
