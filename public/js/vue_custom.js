Vue.component('disabled-field', {
  props:['label', 'value'],
  template: `
            <div class="field has-addons">
              <p class="control">
                <a class="button is-static is-large">
                  {{ label }}
                </a>
              </p>
              <p class="control">
                <input type="text" class="input is-large is-info"
                  :value="value" disabled
                >
              </p>
            </div>
      `
});
/* //====================
  //== CARD WITH IMAGE AND DESCRIPTION: HOME
 //==================== */
Vue.component('card-image', {
  props:['title', 'subtitle'],
  template: `
            <div class="columns">
              <div class="column">
                <div class="card">
                  <div class="card-image">
                    <figure class="image">
                      <slot></slot>
                    </figure>
                  </div>
                  <div class="card-content">
                    <p class="title is-4">{{ title }}</p>
                    <p class="subtitle is-6">{{ subtitle }}</p>
                  </div>
                </div>
              </div>
            </div>
        `
});

/* //====================
  //== MODAL VIEW: FROM jQuery 2.0 Development Cookbook - Ch7 Creating an animated login form - RECIPE 1
 //==================== */
Vue.component('modal-view-image', {
  template: `
            <div class="image-frame">
            	<div class="image-box">
            		<a class="image-btn" href="" ></a>
            		<span></span>
            		<div class="image-actions">
            			<button class="btn image-btn">OK</button>
            		</div>
            	 </div>
            </div>
        `
});

/* //====================
  //== MODAL TO SHOW FILE UPLOAD
 //==================== */
Vue.component('modal-view', {
   props:['header'],
  template: `
          <div class="js_modal">
            <div class="js_modal_header">
                <h3>{{ header }} <a class="close_modal" href="#">&times;</a></h3>
            </div>
            <div class="js_modal_body">

            </div>
            <div class="js_modal_footer">
                <button class="button is-primary close_modal">OK</button>
            </div>
          </div>
        `
});

/*   //====================
   //== FORM FIELD: TOOLTIP
 //==================== */
 Vue.component('form-tooltip', {
   props:['title'],
   template: `
           <p class="control">
             <a>
               <span class="icon" :title="title">
                 <i class="ion-information-circled size24"></i>
               </span>
             </a>
           </p>
   `
 });

/*   //====================
   //== FORM FIELD: UPLOAD FILE
 //==================== */
 Vue.component('form-upload', {
   props:['name', 'text'],
   template: `
         <div class="field has-addons">
           <p class="control">
             <a class="button is-static is-large">
               {{ text }}
             </a>
           </p>
           <p class="control">
             <input name="file" type="file" class="input is-large">
           </p>
         </div>
   `
 });

/*   //====================
   //== FORM FIELD: CHECKBOX
 //==================== */
 Vue.component('form-checkbox', {
   props:['text'],
   template: `
         <div class="field">
           <p class="control">
               <input name="checkbox" type="checkbox" id="checkbox" class="css3checkbox">
               <label for="checkbox" class="toggler">{{ text }}</label>
           </p>
         </div>
       `
 });

/*   //====================
   //== FORM BUTTONS: Submit Cancel
 //==================== */
 Vue.component('form-buttons', {
   props:['url', 'button'],
   template: `
           <div class="field is-grouped is-pulled-right">
             <p class="control">
               <a :href="url" class="button is-white is-large">Cancel</a>
             </p>
             <p class="control">
               <button class="button is-large is_color2">{{ button }}</button>
             </p>
           </div>
       `
 });

/*   //====================
   //== FORM FOOTNOTE
 //==================== */
 Vue.component('form-footnote', {
   template: `
        <div class="mgt_2">
          <abbr title="">
          <p class="heading">required fields are marked with a red border</p>
          </abbr>
        </div>
       `
 });
/*   //====================
   //== DASHBOARD TITLE
 //==================== */
Vue.component('dashboard-title', {
  props:['title'],
  template: `
        <div class="content">
          <h1 class="title is-1 has-text-centered google_font_2">
            {{ title }}
          </h1>
          <div class="border_center"></div>
        </div>
  `
});

/*   //====================
   //== SECTION TITLE
 //==================== */
Vue.component('section-title', {
  props:['title', 'klass'],
  template: `
        <div class="section"
          :class="klass"
        >
          <h1 class="title is-1 has-text-centered google_font_2">
            {{ title }}
          </h1>
        </div>
  `
});

/*   //====================
   //== USED FOR THE OVERVIEW
 //==================== */
 Vue.component('highlights', {
   props:['info', 'heading'],
   template: `
         <div class="level-item has-text-centered">
           <div class="box">
             <p class="title">{{ info }}</p>
             <p class="heading">{{ heading }}</p>
           </div>
         </div>
       `
 });

/*   //====================
   //== LOGIN FORM - SPLITTING SOCIAL LOGIN AND REGULAR LOGIN
 //==================== */
Vue.component('line-splitter', {
  template: `
        <div class="columns mgt_1">
          <div class="column is-5">
            <div class="border_center"></div>
          </div>
          <div class="column is-2">
            <p class="has-text-centered">
              or
            </p>
          </div>
          <div class="column is-5">
            <div class="border_center"></div>
          </div>
        </div>
      `
});

/* //====================
  //== SOCIALITE - SIGN IN WITH FACEBOOK & GOOGLE
 //==================== */
Vue.component('social-signin', {
  props:['facebook', 'google'],
  template: `
        <div class="columns">
          <div class="column">
            <a class="button is-medium is_facebook"
              :href="facebook"
            >
              <span class="icon">
                <i class="ion-social-facebook"></i>
              </span>
              <span>Log in with Facebook</span>
            </a>
          </div>
          <div class="column">
            <a class="button is-medium is_google"
              :href="google"
            >
              <span class="icon">
                <i class="ion-social-googleplus"></i>
              </span>
              <span>Log in with Google</span>
            </a>
          </div>
        </div>
      `
});

/* //====================
  //== DASHBOARD - BULMA "WARNING" MESSAGE
 //==================== */
 Vue.component('warning-msg', {
   props:['msg', 'header'],
   template: `
           <article class="message is-warning"
            v-show="isVisible"
           >
            <div class="message-header">
              <p>{{ header }}</p>
              <button class="delete"
                @click="isVisible=false"
              ></button>
            </div>
            <div class="message-body">
              {{ msg }}
            </div>
          </article>
       `,
   data(){
     return{
       isVisible: false
     };
   }
 });

/* //====================
  //== DASHBOARD - ASIDE MENU
 //==================== */
 Vue.component('aside-menu',{
   props:['klass', 'text', 'link'],
   template: `
         <li>
           <a :href="link">
             <span class="icon"><i :class="klass"></i></span>
              &nbsp; &nbsp; {{text}}
           </a>
         </li>
         `
 });

/* //====================
  //== DASHBOARD - SIDE MENU/PANEL
 //==================== */
 Vue.component('panel-dashboard',{
   props:['klass', 'text', 'link'],
   template: `
         <a class="panel-block"
           :href="link"
         >
         <i style="font-size:24px"
           :class="klass"
         >
         </i> &nbsp; &nbsp;
         {{text}}
         </a>
         `
 });

/* //====================
  //== CARD - CARD CONTENT
 //==================== */
 Vue.component('card-content',{
   props:['klass', 'label', 'value'],
   template: `
         <p>
          <span class="tag is-light">
           <span class="icon">
             <i :class="klass" class="size18"></i>
           </span>
            <small>{{ label }}:</small>
           </span>
           {{ value }}
         </p>
         `
 });

/* //====================
  //== CARD - CARD CONTENT LEVEL
 //==================== */
 Vue.component('card-level',{
   props:['klass', 'text'],
   template: `
         <p class="level-item">
           <span class="icon">
             <i class="size18" :class="klass"></i>
           </span>
           {{ text }}
         </p>
         `
 });

/* //====================
  //== CARD - CARD VIEW BUTTON
 //==================== */
 Vue.component('card-view-button',{
   props: ['link'],
   template: `
        <a class="card-footer-item" title="View"
          :href="link"
        >
           <span class="icon is-small">
             <i class="icon-eye size24"></i>
           </span>
         </a>
         `
 });

/* //====================
  //== CARD - CARD EDIT BUTTON
 //==================== */
 Vue.component('card-edit-button',{
   props: ['link'],
   template: `
        <a class="card-footer-item"
          :href="link"
        >
           <span class="icon is-small" title="Edit">
             <i class="ion-compose size24"></i>
           </span>
         </a>
         `
 });

/* //====================
  //== CARD - CARD DELETE BUTTON
 //==================== */
 Vue.component('card-delete-button',{
   props: ['title'],
   template: `
           <p class="card-footer-item"
            :title="title"
           >
              <a class="button is-static">
                <span class="icon is-small">
                  <i class="ion-trash-a size24"></i>
                </span>
              </a>
            </p>
         `
 });

/* //====================
  //== CARD - CARD DOWNLOAD BUTTON
 //==================== */
 Vue.component('card-download-button',{
   props: ['title'],
   template: `
           <p class="card-footer-item"
            :title="title"
           >
              <a class="button is-static">
                <span class="icon is-small">
                  <i class="ion-ios-download-outline size24"></i>
                </span>
              </a>
            </p>
         `
 });

/* //====================
  //== MODAL TO SHOW AN IMAGE ATTACHMENT
 //==================== */
Vue.component('image-modal', {
  template: `
            <div class="modal is-active">
              <div class="modal-background"></div>
              <div class="modal-content">
                <p class="image">
                  <slot></slot>
                </p>
              </div>
              <button class="modal-close is-large"
                @click="$emit('close')"
              ></button>
            </div>
        `
});

/* //====================
  //== MODAL TO SHOW AN ALERT TO USERS
 //==================== */
Vue.component('alert-modal', {
  template: `
            <div class="modal is-active">
              <div class="modal-background"></div>
              <div class="modal-card">

                <header class="modal-card-head">
                  <p class="modal-card-title">
                    <slot name="header"></slot>
                  </p>
                  <button class="delete"
                    @click="$emit('close')"
                  ></button>
                </header>

                <section class="modal-card-body">
                  <slot></slot>
                </section>

                <footer class="modal-card-foot">
                  <slot name="footer">
                    <a class="button is-success">Save changes</a>
                    <a class="button"
                      @click="$emit('close')"
                    >Cancel</a>
                  </slot>
                </footer>
              </div>
            </div>
        `
});

/* //====================
  //== MODAL TO SHOW AN ALERT TO USERS
 //==================== */
Vue.component('details-modal', {
  template: `
            <div class="modal is-active">
              <div class="modal-background"></div>
              <div class="modal-card">
                <header class="modal-card-head">
                  <p class="modal-card-title">
                    Details
                  </p>
                  <button class="delete"
                    @click="$emit('close')"
                  ></button>
                </header>
                <section class="modal-card-body">
                  <slot></slot>
                </section>

                <footer class="modal-card-foot">
                  <a class="button is-success"
                    @click="$emit('close')"
                  >OK
                  </a>
                </footer>
              </div>
            </div>
        `
});

/* //====================
  //== HERO - DASHBOARD
 //==================== */
Vue.component('hero-dashboard', {
  props: ['header', 'subheader'],
  template: `
      <section class="hero is_color1">
        <div class="hero-body">
          <div class="container">

            <h1 class="title google_font_1">
              {{ header }}
              <a href="/dashboard" class="button is-link">see workflow</a>
              <slot></slot>
            </h1>

            <h2 class="subtitle">
              {{ subheader }}
            </h2>

          </div>
        </div>
      </section>
      `
});

/* //====================
  //== BULMA ALERT
 //==================== */
Vue.component('alert-bulma', {
  props:['msg', 'klass', 'url'],
  template: `
          <div class="columns"
            v-show="isVisible"
          >
            <div class="column is-half is-offset-one-quarter">
              <div class="notification"
                :class="klass"
              >
              <button class="delete"
                @click="isVisible=false"
              ></button>
              {{ msg }}
                <a :href="url" v-show="url != 'false'">here</a>
              </div>
            </div>
          </div>
        `,
  data(){
    return{
      isVisible: true
    };
  }
});

/* //====================
  //== BULMA ALERT - NO CLOSE BUTTON
 //==================== */
Vue.component('alert-nobtn', {
  props:['msg', 'klass'],
  template: `
          <div class="columns" v-show="true">
            <div class="column">
              <div class="notification"
                :class="klass"
              >
              {{ msg }}
              </div>
            </div>
          </div>
        `
});

new Vue({
  el: "#wrapper",
  data: {
    showModal: false,
    showForm: false,
    formModal: false,
    formModal2: false,
    notificationVisible: true,
    alertVisible: true,
    contact_name: '',
    contact_message: '',
    flag_contact_name: false,
    flag_contact_message: false,
    interviewCreate: true,
  },
  methods:{
    removeMsg(){
      this.alertVisible=false;
    },
    nameFieldValidation(){
      if(this.contact_name.length < 3){
        this.flag_contact_name = true;
      }
    },
    messageFieldValidation() {
      if(this.contact_message.length < 6){
        this.flag_contact_message = true;
      }
    },
    emailFieldValidation() {
      if(this.contact_name.length < 3){
        this.flag_contact_name = true;
      }
    },
    removeWarning(item) {
      if(item == "name") this.flag_contact_name = false;
      if(item == "comment") this.flag_contact_message = false;
      this.isVisible = false;
    }
  },
  computed:{
    btn_disabled(){
      if(this.contact_message.length > 10){
        return false;
      }
      return true;
    },
    message_length_remaining(){
      if(this.contact_message.length > 0){
        remaining = 400 - this.contact_message.length;
        if(remaining < 400 && remaining > -1){
          return "Characters remaining: " + remaining;
        }
        if(remaining < 0){
          return "You have exceeded 400 characters. Please go back and make the necessary changes or your message will not be accepted.";
        }
      }
    },
    classObject(){
      return{
        'is-info': this.contact_message.length > 1,
        'is-danger': this.contact_message.length > 400,
      }
    }


  }

});
