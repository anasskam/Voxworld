const file = document.getElementById("file-upload");
const fileInfo = document.querySelector(".file-info");
const uploadField = document.querySelector(".upload-field");

function updateFileInfo(){
  if(file.files.length > 0){
    const selectedFile = file.files[0];
    fileInfo.textContent = `File uploaded: ${selectedFile.name}, (${selectedFile.size} bytes)`;
    fileInfo.classList.remove("opacity-half");
  }
  else {
    fileInfo.textContent = `Uplaod image`;
    fileInfo.classList.add("opacity-half");
  }
}

// ckeditor rich text
const editor = document.getElementById("editor");

const properties =  {
  toolbar: {
      items: [
          'undo', 'redo', 'heading', 'fontFamily', 'fontSize', '|',
          'bold', 'italic', 'underline', 'strikethrough', 'fontColor', 'fontBackgroundColor', '|', 'link', 'blockQuote', '|','bulletedList', 'numberedList', 'todoList', '|', 'alignment', '|', 'outdent', 'indent', '|',
          
      ],

      shouldNotGroupWhenFull: true
  },
  list: {
      properties: {
          styles: true,
          startIndex: true,
          reversed: true
      }
  },
  heading: {
      options: [
          { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
          { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
          { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
          { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
          { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
          { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
          { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
      ]
  },
  placeholder: 'Write new article here',

  fontFamily: {
      options: [
          'default',
          'Arial, Helvetica, sans-serif',
          'Courier New, Courier, monospace',
          'Georgia, serif',
          'Lucida Sans Unicode, Lucida Grande, sans-serif',
          'Tahoma, Geneva, sans-serif',
          'Times New Roman, Times, serif',
          'Trebuchet MS, Helvetica, sans-serif',
          'Verdana, Geneva, sans-serif'
      ],
      supportAllValues: true
  },

  fontSize: {
      options: [ 10, 12, 14, 'default', 18, 20, 22 ],
      supportAllValues: true
  },

  htmlSupport: {
      allow: [
          {
              name: /.*/,
              attributes: true,
              classes: true,
              styles: true
          }
      ]
  },

  link: {
      decorators: {
          addTargetToExternalLinks: true,
          defaultProtocol: 'https://',
          toggleDownloadable: {
              mode: 'manual',
              label: 'Downloadable',
              attributes: {
                  download: 'file'
              }
          }
      }
  },
}

ClassicEditor.create(editor, properties).then(editor =>{
  console.log("Editor was initialized", editor );
}).catch( error => {
  console.error(error.stack);
})

// submit the form when click on the publish button
const formPublishBtn = document.querySelector(".publish-form-btn");
const headerPublishBtn = document.querySelector(".publish-header-btn");

const post = {
    title:"",
    category:"",
    content:""
}

function update(field, newVal){
    post[field] = newVal;
    localStorage.setItem("post", JSON.stringify(post));
}

document.addEventListener("DOMContentLoaded",()=>{
    headerPublishBtn.addEventListener("click" , ()=> {formPublishBtn.click()});
    const postTitle = document.querySelector(".title-field input");
    const postCateogry = document.querySelector(".categories-field select");
    const postContent = document.querySelector("[role='textbox']");
    const form = document.getElementById("createPostForm");

    if(localStorage.getItem("post")){
        const post = JSON.parse(localStorage.getItem("post"));
        postTitle.value = post.title;
        postCateogry.value = post.category;
        postContent.textContent = post.content;
    }

    postTitle.addEventListener("input", function(e){
        update("title", postTitle.value)
    })
    
    postCateogry.addEventListener("input", function(e){
        update("category", postCateogry.value)
    })
    
    //update the content input
    postContent.addEventListener("keyup", function(e){
        update("content", postContent.innerHTML);
    })
    postContent.addEventListener("blur", function(e){
        update("content", postContent.innerHTML);
    })

})


file.addEventListener("change", updateFileInfo)
uploadField.addEventListener("click", ()=> {file.click()});
