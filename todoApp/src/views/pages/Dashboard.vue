<template>
  <ion-page>
    <ion-router-outlet></ion-router-outlet>
    <ion-menu content-id="main-content">
      <ion-header>
        <ion-toolbar class="ion-text-center">
          <ion-title>TODO</ion-title>
        </ion-toolbar>
      </ion-header>
      <ion-content class="ion-padding">
        <ion-list>
          <ion-item lines="full" button @click="$router.push('dashboard')">
            <ion-label>Home</ion-label>
            <ion-icon slot="start" :icon="home"></ion-icon>
          </ion-item>
        </ion-list>
        <ion-button @click="logout" class="ion-padding" expand="block" color="danger">LOGOUT</ion-button>
      </ion-content>
    </ion-menu>

    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-menu-button></ion-menu-button>
        </ion-buttons>
        <ion-title class="ion-text-center">TODO</ion-title>
        <ion-buttons slot="end" @click="setOpen(true)">
          <ion-button>
            <ion-icon :icon="add" v-if="!addTextField"></ion-icon>
          </ion-button>
        </ion-buttons>
      </ion-toolbar>
    </ion-header>

    <ion-content :fullscreen="true" id="main-content">

        <ion-item v-for="todo in todos" :key="todo.todo_id">
          <ion-checkbox v-model="todo.status"></ion-checkbox>
          <ion-label :class="{ active : todo.status == true }" class="ion-padding-start ion-text-wrap">{{ todo.title }} - {{ todo.todo_id }}</ion-label>
          <ion-buttons v-if="todo.status == true">
            <ion-button @click="deleteItem(todo.todo_id)" slot="end"><ion-icon :icon="trash"></ion-icon></ion-button>
          </ion-buttons>
        </ion-item>

        <ion-modal :is-open="isOpen">
          <ion-header>
            <ion-toolbar>
              <ion-title color="medium">New Task</ion-title>
              <ion-buttons slot="end">
                <ion-button @click="setOpen(false)"><ion-icon :icon="close"></ion-icon></ion-button>
              </ion-buttons>
            </ion-toolbar>
          </ion-header>
          <ion-content class="ion-padding">
            <ion-list>
              <ion-item>
                  <ion-input v-model="title" label="Title" label-placement="stacked" type="text" name="title" :clear-input="true" placeholder="Enter title"></ion-input>
              </ion-item>
              <ion-item>
                  <ion-input v-model="description" label="Description" label-placement="stacked" type="text" name="description" :clear-input="true" placeholder="Enter description"></ion-input>
              </ion-item>
              <ion-item>
                  <ion-input label="Created_At" label-placement="stacked" v-model="created_at" type="text" disabled></ion-input>
              </ion-item>
              <ion-button @click="addData" class="ion-padding ion-margin-bottom" expand="block">
                <span v-if="!loaderIcon">ADD</span>
                <span v-if="loaderIcon"><ion-spinner name="crescent"></ion-spinner></span>
              </ion-button>
            </ion-list>
          </ion-content>
        </ion-modal>

    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel, IonModal, IonSpinner, IonMenu, IonRouterOutlet, IonMenuButton } from '@ionic/vue';
import { add, close, trash, home } from 'ionicons/icons';
import api from '@/main';
import { Toast } from '@capacitor/toast';

export default({
  name: 'DashboardPage',
  components: { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel, IonModal, IonSpinner, IonMenu, IonRouterOutlet, IonMenuButton },
  setup() { return { add, close, trash, home } },
  data() {
      return {
        addTextField: false,
        newTask: '',
        isChecked: false,
        todos: [],
        isOpen: false,
        title: '',
        description: '',
        created_at: new Date().toLocaleString(),
        loaderIcon: false,
        storage: JSON.parse(localStorage.getItem('user'))
      }
  },
  methods: {
    logout() {
      localStorage.clear();
      this.$router.push('login');
      setTimeout(() => window.location.reload(), 2000);
    },
    addNew() {
      this.addTextField = !this.addTextField;
    },
    setOpen(isOpen) {
      this.isOpen = isOpen;
    },
    addData() {
      if(this.title == '' || this.description == '') {
          Toast.show({
              text: 'All Fields are Required!',
              duration: 5000,
              position: 'top',
          });

          return;
      }else {
        this.loaderIcon = true;

          const formData = new FormData();
          formData.append('user_id', this.storage.id);
          formData.append('title', this.title);
          formData.append('description', this.description);

          api.post('add', formData).then(() => {
              Toast.show({
                  text: 'Added Succesfully!',
                  duration: 5000,
                  position: 'top',
              });

              setTimeout(() => {
                window.location.reload();
              }, 3000)
          })
      }
    },
    deleteItem(id) {
      const formData = new FormData();
      formData.append('id', id);

      api.post('delete/', formData)
      .then(response => {
          console.log(response.data);
      })
      .catch(error => {
          console.log(error)
      })
    }
  },
  mounted() {
    api.get('/').then(res => {
      res.data.result.forEach(res => {
        if(res.id == this.storage.id) {
          this.todos.push(res);
        }
      });
    });
  }
});
</script>


<style scoped>
.textField ion-buttons {
  background: #428cff;
}

.active {
  text-decoration: line-through;
  --color: #ff4961 !important;
}
</style>