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

        <ion-text class="noTask" color="medium" v-if="isLoading">Loading Task...</ion-text>

        <ion-item v-else v-for="todo in todos" :key="todo.todo_id">
          <ion-checkbox v-model="todo.status"></ion-checkbox>
          <ion-label :class="{ active : todo.status == true }" class="ion-padding-start ion-text-wrap">{{ todo.title }}</ion-label>
          <ion-buttons>
            <ion-button @click="getItem(todo.todo_id); setOpen2(true)" slot="end"><ion-icon :icon="create"></ion-icon></ion-button>
          </ion-buttons>
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

        <ion-modal :is-open="isOpen2">
          <ion-header>
            <ion-toolbar>
              <ion-title color="medium">Update Task</ion-title>
              <ion-buttons slot="end">
                <ion-button @click="setOpen2(false)"><ion-icon :icon="close"></ion-icon></ion-button>
              </ion-buttons>
            </ion-toolbar>
          </ion-header>
          <ion-content class="ion-padding">
            <ion-list>
              <ion-item>
                  <ion-input v-model="editTitle" label="Title" label-placement="stacked" type="text" name="title" :clear-input="true" placeholder="Enter title"></ion-input>
              </ion-item>
              <ion-item>
                  <ion-input v-model="editDescription" label="Description" label-placement="stacked" type="text" name="description" :clear-input="true" placeholder="Enter description"></ion-input>
              </ion-item>
              <ion-item>
                  <ion-input label="Updated_At" label-placement="stacked" v-model="updated_at" type="text" disabled></ion-input>
              </ion-item>
              <ion-button @click="updateItem" class="ion-padding ion-margin-bottom" expand="block">
                <span v-if="!loaderIcon">UPDATE</span>
                <span v-if="loaderIcon"><ion-spinner name="crescent"></ion-spinner></span>
              </ion-button>
            </ion-list>
          </ion-content>
        </ion-modal>

    </ion-content>
  </ion-page>
</template>

<script>
import { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel, IonModal, IonSpinner, IonMenu, IonRouterOutlet, IonMenuButton, IonText } from '@ionic/vue';
import { add, close, trash, home, create } from 'ionicons/icons';
import axiosRes from '@/main';
import { Toast } from '@capacitor/toast';

export default({
  name: 'DashboardPage',
  components: { IonContent, IonPage, IonToolbar, IonHeader, IonTitle, IonButtons, IonButton, IonItem, IonInput, IonList, IonIcon, IonCheckbox, IonLabel, IonModal, IonSpinner, IonMenu, IonRouterOutlet, IonMenuButton, IonText },
  setup() { return { add, close, trash, home, create } },
  data() {
      return {
        addTextField: false,
        newTask: '',
        isChecked: false,
        todos: [],
        isOpen: false,
        isOpen2: false,
        title: '',
        editTitle: '',
        description: '',
        editDescription: '',
        created_at: new Date().toLocaleString(),
        updated_at: new Date().toLocaleString(),
        loaderIcon: false,
        storage: JSON.parse(localStorage.getItem('user')),
        isLoading: true,
        todoID: ''
      }
  },
  methods: {
    getItem(id) {
      this.todos.forEach(res => {
        if(res.todo_id == id) {
          this.todoID = res.todo_id;
          this.editTitle = res.title;
          this.editDescription = res.description;
        }
      });
    },
    updateItem() {
      const formData = new FormData();
      formData.append('todo_id', this.todoID);
      formData.append('editTitle', this.editTitle);
      formData.append('editDescription', this.editDescription);

      axiosRes.post('/update/', formData).then(res => {
        console.log(res.data.result);
        window.location.reload();
      })
    },
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
    setOpen2(isOpen2) {
      this.isOpen2 = isOpen2;
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

          axiosRes.post('/add/', formData).then(() => {
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

      axiosRes.post('/delete/', formData).then(res => {
          console.log(res.data);
      })
    }
  },
  mounted() {
    axiosRes.get('/').then(res => {
      res.data.result.forEach(res => {
        if(res.id == this.storage.id) {
          this.todos.push(res);
          this.isLoading = false;
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

.noTask {
  display: block;
  text-align: center;
  margin-top: 60px;
}
</style>