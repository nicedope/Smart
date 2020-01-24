

 <table id="tbl_users_list" border="1">
  <tr>
   <td>#ID</td>
   <td>FB_ID</td>
   <td>NAME</td>
   <td>EMAIL</td>
  </tr>
 </table>

<script type="text/javascript">

	$(function(){
		var databaseRef = firebase.database().ref('tbl_user/');

		firebase.auth().onAuthStateChanged(function(user) {
			if (user) {
				alert("LOGIN");
				user.providerData.forEach(function (profile) {
					console.log("Sign-in provider: " + profile.providerId);
					console.log("  Provider-specific UID: " + profile.uid);
					console.log("  Name: " + profile.displayName);
					console.log("  Email: " + profile.email);
					console.log("  Photo URL: " + profile.photoURL);
				});
			} else {
				alert("LOGOUT");
			}
		});

		var tblUsers = document.getElementById('tbl_users_list');
		var databaseRef = firebase.database().ref('users/');
		var rowIndex = 1;

		databaseRef.once('value', function(snapshot) {
			snapshot.forEach(function(childSnapshot) {
				var childKey = childSnapshot.key;
				var childData = childSnapshot.val();

				var row = tblUsers.insertRow(rowIndex);
				var cellId = row.insertCell(0);
				var cellName = row.insertCell(1);
				cellId.appendChild(document.createTextNode(childKey));
				cellName.appendChild(document.createTextNode(childData.user_name));

				rowIndex = rowIndex + 1;
			});
		});

		function save_user(){
			var user_name = document.getElementById('user_name').value;

			var uid = firebase.database().ref().child('users').push().key;

			var data = {
				user_id: uid,
				user_name: user_name
			}

			var updates = {};
			updates['/users/' + uid] = data;
			firebase.database().ref().update(updates);

			alert('The user is created successfully!');
			reload_page();
		}

		function update_user(){
			var user_name = document.getElementById('user_name').value;
			var user_id = document.getElementById('user_id').value;

			var data = {
				user_id: user_id,
				user_name: user_name
			}

			var updates = {};
			updates['/users/' + user_id] = data;
			firebase.database().ref().update(updates);

			alert('The user is updated successfully!');

			reload_page();
		}

		function delete_user(){
			var user_id = document.getElementById('user_id').value;

			firebase.database().ref().child('/users/' + user_id).remove();
			alert('The user is deleted successfully!');
			reload_page();
		}

		function reload_page(){
			window.location.reload();
		}
	});	

</script>