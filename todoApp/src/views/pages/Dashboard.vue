<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>TODO</ion-title>
        <ion-buttons slot="end" @click="addNew">
          <ion-button>
            <ion-icon :icon="add" v-if="!addTextField"></ion-icon>
            <ion-icon :icon="close" v-else></ion-icon>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-list v-if="addTextField" class="textField">
          <ion-item>
              <ion-buttons slot="end">
                <ion-button>Add</ion-button>
              </ion-buttons>
              <ion-input v-model="newTask" type="text" name="newTask" :clear-input="true" placeholder="Enter new task"></ion-input>
          </ion-item>
        </ion-list>

        <ion-item v-for="todo in todos" :key="todo">
          <ion-checkbox v-model="isChecked"></ion-checkbox>
          <ion-label class="ion-padding-start ion-text-wrap">{{ todo.title }}</ion-label>
          <ion-buttons v-if="isChecked">
            <ion-button slot="end"><ion-icon :icon="trash"></ion-icon></ion-button>
          </ion-buttons>
        </ion-item>
    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel } from '@ionic/vue';
import { add, close, trash } from 'ionicons/icons';
import api from '@/main';

export default({
  name: 'DashboardPage',
  components: { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel },
  setup() { return { add, close, trash } },
  data() {
      return {
        addTextField: false,
        newTask: '',
        isChecked: false,
        todos: ''
      }
  },
  methods: {
    addNew() {
      this.addTextField = !this.addTextField;
    }
  },
  mounted() {
    api.get('/').then(res => {
      this.todos = res.data.result;
    });
  }
});
</script>


<style scoped>
.textField ion-buttons {
  background: #428cff;
}

ion-item ion-label {
  text-decoration: line-through;
  --color: #ff4961 !important;
}
</style>