<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div id="app_vue">
		<h1>{{ mensaje }}</h1>
		<router-link to="/Estudiantes">Estudiantes</router-link>
		<router-link to="/">Principal</router-link>

		<router-view></router-view>
	</div>

	<script src="./Views/Js/Vue.js"></script>
	<script src="./Views/Js/Vue-router.js"></script>
	<script>
		Vue.createApp({
			data(){
				return{
					mensaje: "Hola desde Vue3",
					Vistas:[],
					Vista: '',
				}
			},
			methods:{
				async RequireView(){
					let vistas = [
						{url: "", archivo: "Principal"},
						{url: "Estudiantes", archivo: "Estudiantes"}
					];

					await vistas.map( async (e) => {
						return await fetch(`./Views/Contents/${e.archivo}.php`).then( res => res.text()).then( html => {
							this.Vistas.push({
								url: e.url, archivo: html
							});
						})
						.catch( error => {
							console.error(error)
							return []
						})
					})
				},
				RenderView(){
					console.log("Render view")
				}
			},
			async mounted(){
				await this.RequireView();
				console.log(this.Vistas)
			}
		}).mount("#app_vue");

		// app.use(router);

	</script>
</body>
</html>