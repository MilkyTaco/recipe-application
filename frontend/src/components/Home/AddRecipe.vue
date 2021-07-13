<template>
 <div>
  <div class="container" >
   <div class="row justify-content-center align-items-center mt-content" >
    <div class="addrecipe-card mb-5">
    <v-row>
     <v-col
       cols="12"
       sm="11"
       md="6">
       <v-text-field
         label="Title"
         outlined
         v-model="data.title"
       ></v-text-field>
       <v-textarea
          solo
          name="input-7-4"
          label="Description"
         v-model="data.description"
        ></v-textarea>
        <v-row>
        <v-col cols="12" sm="12" md="6">
          <p>Categories</p>
          <select v-model="data.category" name="category" id="category" class="form-select">
            <option :value="categ.id" v-for="(categ, i) in categories" :key="i">{{categ.name}}</option>
          </select>
        </v-col>
        <v-col cols="12" sm="12" md="6">
          <p>Categories</p>
          <VueFileAgent
            ref="vueFileAgent"
            @select="filesSelected($event)"
            :multiple="false"
            :maxSize="'5MB'"
            :deletable="true"
            :accept="'image/*,'"
            :theme="'grid'"
            @beforedelete="onBeforeDelete($event)"
            @delete="fileDeleted($event)"
            :errorText="{
              type: 'Invalid file type. Only image file is Allowed',
              size: 'Image should not exceed 5MB in size',
            }"
            v-model="fileRecords"
          ></VueFileAgent>
        </v-col>
      </v-row>
     </v-col>
     <v-col
       cols="12"
       sm="11"
       md="6">
       <p>Content</p>
       <vue-editor
            id="editor"
            :customModules="customModulesForEditor"
            :editorOptions="editorSettings"
            :editorToolbar="customToolbar"
            useCustomImageHandler
            v-model="data.content"
            @image-added="handleImageAdded"
          />
        <v-row class="mt-4 ml-1">
        <v-btn
          elevation="1"
          class="mt-3 mr-2"
          color="success"
          v-on:click.prevent="saveRecipe"
        >Save Recipe</v-btn>
        <router-link to="/menu"><v-btn
          elevation="1"
          class="mt-3"
          color="success"
        >Cancel</v-btn></router-link>
        </v-row>
     </v-col>
    </v-row>
    </div>
   </div>
  </div>
 </div>
</template>
<script>
import { VueEditor } from "vue2-editor";
import ImageResize from "quill-image-resize-vue";
import { ImageDrop } from "quill-image-drop-module";
import { mapState } from 'vuex';
export default {
 components: { VueEditor },
 data() {
    return {
      customModulesForEditor: [
        { alias: "imageDrop", module: ImageDrop },
        { alias: "imageResize", module: ImageResize },
      ],
      editorSettings: {
        modules: {
          imageDrop: true,
          imageResize: {},
        },
      },
      customToolbar: [
        [{ font: [] }],
        [{ header: [false, 1, 2, 3, 4, 5, 6] }],
        ["bold", "italic", "underline", "strike"],
        [
          { align: "" },
          { align: "center" },
          { align: "right" },
          { align: "justify" },
        ],
        ["blockquote", "code-block"],
        [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
        [{ script: "sub" }, { script: "super" }],
        [{ indent: "-1" }, { indent: "+1" }],
        [{ color: [] }, { background: [] }],
        ["link", "image", "formula"],
        [{ direction: "rtl" }],
        ["clean"],
      ],
      data: {
        title: "",
        description: "",
        featured_image: "",
        category_id: 1,
        content: "",
      },
      uploadUrl: "/uploadFImage",
      fileRecords: [],
      fileRecordsForUpload: [],
    };
  },
  mounted() {
   this.getCategories()
  },
  methods: {
 filesSelected: function(fileRecordsNewlySelected) {
      var validFileRecords = fileRecordsNewlySelected.filter(
        (fileRecord) => !fileRecord.error
      );
      this.fileRecordsForUpload = this.fileRecordsForUpload.concat(
        validFileRecords
      );
    },
    handleImageAdded: function(file) {
      var formData = new FormData();
      formData.append("image", file);
    },
    fileDeleted: function(fileRecord) {
      var i = this.fileRecordsForUpload.indexOf(fileRecord);
      if (i !== -1) {
        this.fileRecordsForUpload.splice(i, 1);
      }
    },
    onBeforeDelete: function(fileRecord) {
      var i = this.fileRecordsForUpload.indexOf(fileRecord);
      if (i !== -1) {
        this.fileRecordsForUpload.splice(i, 1);
        var k = this.fileRecords.indexOf(fileRecord);
        if (k !== -1) this.fileRecords.splice(k, 1);
      }
    },
    async saveRecipe() {
      if (this.data.title == "") return this.$toast.error("Title is required");
      if (this.data.description == "")
        return this.$toast.error("Description is required");
      if (this.data.category_id == "")
        return this.$toast.error("Category is required");
      if (this.data.content == "")
        return this.$toast.error("Content is required");
      if (this.fileRecordsForUpload.length == 0)
        return this.$toast.error("Featured Image is required");

      const res = await this.$refs.vueFileAgent.upload(
        `http://127.0.0.1:8000/api/uploadFeaturedImage?token=${localStorage.getItem('token')}`,
        { "X-Requested-With": "XMLHttpRequest" },
        this.fileRecordsForUpload
      );
      
      this.data.image = res[0].data
      const info = await this.$store.dispatch('recipe/storeRecipe', this.data);
      if (info.status == 200) {
        this.$router.push("/menu");
        this.$toast.success("Recipe saved successfully!");
      } else {
        this.$toast.error("Something went wrong");
      }
    },
   async getCategories(){
    await this.$store.dispatch('category/getCategories')
   },
  },
  computed: {
   ...mapState('category', ['categories'])
  }
}
</script>
<style>
.addrecipe-card {
 background: white;
 height: 100%;
 position: relative;
 padding: 2rem 3rem;
 border-radius: 10px;

}

.mt-content {
 margin-top: 100px;
}

.form-select {
    display: block;
    width: 100%;
    padding: .375rem 2.25rem .375rem .75rem;
    -moz-padding-start: calc(0.75rem - 3px);
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right .75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
}
@import "~vue2-editor/dist/vue2-editor.css";
</style>