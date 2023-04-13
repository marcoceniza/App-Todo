<template>
  <ion-page>
    <ion-content :fullscreen="true">
      <div id="splash-screen">
        <img src="@/images/todo_logo.png" alt="splash screen"/>
      </div>
      <div id="container">
        <img src="@/images/todo_logo.png" alt="todo logo">
        <ion-button @click="$router.push('/login')">SIGNIN</ion-button>
        <ion-button @click="$router.push('/register')">SIGNUP</ion-button>
      </div>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage, IonButton } from '@ionic/vue';

export default({
    name: 'WelcomePage',
    components: { IonContent, IonPage, IonButton },
    mounted() {
      setTimeout(() => {
        const splash = document.getElementById('splash-screen');
        if (splash) splash.style.display = 'none';
      }, 3000);
    }
});
</script>


<style scoped>

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

#splash-screen {
  display: flex;
  justify-content: center;
  align-items: center;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ffffff;
  z-index: 99999;
  }

#splash-screen img {
  width: 125px;
  max-width: 100%;
  animation-name: splash-animation;
  animation-duration: 2s;
  animation-fill-mode: both;
}

@keyframes splash-animation {
  0% {
    opacity: 0;
    bottom: -10%;
  }
  100% {
    opacity: 1;
    bottom: 0;
  }
}

</style>