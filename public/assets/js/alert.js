function confirmDelete(deleteUrl) {
  Swal.fire({
    title: "Are you sure",
    text: "To Delete This Post?",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then((result) => {
    if (result.value) {
      window.location.href = deleteUrl; // Redirect to delete URL if confirmed
    }
  });
}

function confirmEdit(editUrl) {
  Swal.fire({
    title: "Are you sure",
    text: "To Edit This Post?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, lemme edit it!",
  }).then((result) => {
    if (result.value) {
      window.location.href = editUrl; // Redirect to delete URL if confirmed
    }
  });
}

function logout(logoutUrl) {
  Swal.fire({
    title: "Are you sure",
    text: "You want to logout?",
    type: "info",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, lemme log out!",
  }).then((result) => {
    if (result.value) {
      window.location.href = logoutUrl; // Redirect to delete URL if confirmed
    }
  });
}

function setting(changePassword, changeEmail) {
  Swal.fire({
    title: "Setting",
    showDenyButton: true,
    confirmButtonText: "Change Password",
    confirmButtonColor: "#3085d6",
    denyButtonText: `Change Email`,
    denyButtonColor: "#3085d6",
   
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = changePassword;
    } else if (result.isDenied) {
      window.location.href = changeEmail;
    }
  });
}

function createalbum(createalbumUrl) {
  Swal.fire({
    input: "text",
    inputLabel: "Create New Album",
    inputPlaceholder: "Enter album name...",
    showCancelButton: true,
    confirmButtonText: "Create",
    cancelButtonText: "Cancel",
    inputAttributes: {
      autocomplete: "off"
    },
    inputValidator: (value) => {
      if (value == "") {
        resolve("You need to enter an album name");
      } else {
        const album = createalbumUrl + value;
        window.location.href = album;
      }
    },
  }); 
}

function albumcreatedsuccess() {
 
}
