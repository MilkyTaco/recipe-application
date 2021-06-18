<script>
import axios from "axios";
export default {
	name: "Login",
	data() {
		return {
			form: { email: "", password: "" },
			errorMessage: "",
		};
	},
	methods: {
		async handleSubmit(e) {
			e.preventDefault();
			try {
				const { data } = await axios.post(
					"http://localhost/api/user/login",
					this.form
				);

				sessionStorage.setItem(
					"Authorization",
					`Bearer  ${data.token}`
				);
				this.$router.push("/home");
			} catch (e) {
				return (this.errorMessage =
					e.response.data.errors.message);
			}
		},
	},
};
</script>
<template>
	<v-container>
		<v-row justify="center" align-content="center">
			<v-col align-self="center" sm="4">
				<v-card elevate="2" class="card-body">
					<v-form @submit="handleSubmit">
						<v-row
							justify-content="stretch"
							align-content="center"
						>
							<v-col
								align-self="stretch"
								cols="12"
							>
								<h2>
									Recipe
									Application
								</h2>
							</v-col>
							<v-col
								align-self="center"
								cols="12"
							>
								<v-subheader>
									Login
									with
									your
									account.
								</v-subheader>
							</v-col>
							<v-col
								cols="12"
								tag="col"
							>
								<v-text-field
									class="input-text"
									v-model="
										form.email
									"
									label="email"
								/>
							</v-col>
							<v-col
								cols="12"
								tag="col"
							>
								<v-text-field
									class="input-text"
									v-model="
										form.password
									"
									label="password"
									type="password"
								/>
							</v-col>
							<v-col
								cols="12"
								align-self="stretch"
							>
								<v-btn
									class="login-button"
									type="submit"
									color="error"
									>Login</v-btn
								>
							</v-col>
							<v-col align-self="center" v-if="errorMessage">
								<p>{{ errorMessage}} </p>
							</v-col>
						</v-row>
					</v-form>
				</v-card>
			</v-col>
		</v-row>
	</v-container>
</template>
<style lang="scss" scoped>
.login-button {
	width: 100%;
}
.card-body {
	padding: 20px 15px 10px 15px;
}
h2 {
	text-align: center;
	margin: 0px;
	color: rgba(0, 0, 0, 0.8);
}
.input-text {
	margin: 0px;
	font-size: 12px;
}
p {
	margin: 0px;
	padding: 2px;
	font-weight: bold;
	font-size: 12px;
	color: white;
	background-color: red;
	text-align: center;
}
</style>
