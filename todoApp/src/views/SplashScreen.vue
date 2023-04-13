<template>
    <ion-page>
      <ion-content :fullscreen="true">
        <!-- <div id="container" class="splashscreen">
          <img src="@/images/todo_logo.png" alt="todo logo">
        </div> -->
      </ion-content>
    </ion-page>
  </template>
  
  <script>
  import { IonContent, IonPage } from '@ionic/vue';
  import { SplashScreen } from '@capacitor/splash-screen';
  import { defineCustomElements } from '@ionic/pwa-elements/loader';
  defineCustomElements(window);
  
  export default({
      name: 'SplashScreenView',
      components: { IonContent, IonPage },
      mounted() {
        SplashScreen.show({
            autoHide: true,
            showDuration: 3000,
            backgroundColor: '#ffffff',
            splashFullScreen: true,
            splashImmersive: false,
            splash: true,
            image: '@/images/todo_logo.png',
        });

        setTimeout(() => {
            SplashScreen.hide();
        }, 3000)
      }
  });
  </script>
  
  
  <style scoped>
  .splashscreen {
    background-image: url('@/images/todo_logo.png');
    background-size: cover;
    background-position: center;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 9999;
  }
  
  #container {
    text-align: center;
    
    position: absolute;
    left: 0;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
  }
  
  #container strong {
    font-size: 20px;
    line-height: 26px;
  }
  
  #container p {
    font-size: 16px;
    line-height: 22px;
    
    color: #8c8c8c;
    
    margin: 0;
  }
  
  #container a {
    text-decoration: none;
  }
  
  #container img {
    width: 115px;
    display: block;
    margin: 0 auto 35px;
    max-width: 100%;
  }
  
  </style>