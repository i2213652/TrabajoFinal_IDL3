<template>
	<!-- Modal -->
	<b-modal ref="mdlDatosSector" hide-footer :title="titulo">
		<div class="d-block">
			<b-form>
				<b-form-group label="Sector">
					<b-form-input
						v-model="frmDatosSector.sector"
						type="text"
						placeholder="Ingrese el sector"
						required
					></b-form-input>
				</b-form-group>
				<b-form-textarea
					v-model="frmDatosSector.descripcion"
					placeholder="Descripción..."
					rows="3"
					max-rows="6"
				></b-form-textarea>
				<b-form-checkbox
					v-model="frmDatosSector.habilitado"
					v-if="modo == 'EDITAR'"
					value="1"
					unchecked-value="0"
				>
					Habilitado
				</b-form-checkbox>
			</b-form>
		</div>
		<b-button
			class="mt-3"
			variant="outline-success"
			block
			@click="Guardar"
			v-if="modo == 'NUEVO'"
			>Guardar</b-button
		>
		<b-button
			class="mt-3"
			variant="outline-success"
			block
			@click="Actualizar"
			v-if="modo == 'EDITAR'"
			>Actualizar</b-button
		>

		<b-button class="mt-3" variant="outline-danger" block @click="Cerrar"
			>Cerrar</b-button
		>
	</b-modal>
</template>

<script>
import axios from "axios";
export default {
	props: {},
	data() {
		return {
			modo: null,
			frmDatosSector: {
				id: null,
				sector: null,
				descripcion: null,
				habilitado: 0,
			},
		};
	},
	computed: {
		titulo() {
			let valor = null;

			if (this.modo == "NUEVO") {
				valor = "NUEVO SECTOR";
			} else if (this.modo == "EDITAR") {
				valor = "EDITAR SECTOR";
			}

			return valor;
		},
	},
	methods: {
		Abrir() {
			this.$refs["mdlDatosSector"].show();
		},
		Cerrar() {
			this.$refs["mdlDatosSector"].hide();
		},
		Guardar() {
			let self = this;
			if (this.frmDatosSector.sector == null) {
				this.$swal.fire({
					icon: "error",
					title: "¡Ups!",
					text: "El SECTOR no puede quedar vacío.",
				});
				return false;
			}

			this.$swal
				.fire({
					icon: "question",
					text: "¿DESEA REGISTRAR ESTE SECTOR?",
					confirmButtonText: "Si",
					showCancelButton: true,
					cancelButtonText: "No",
					allowOutsideClick: false,
				})
				.then(async (result) => {
					if (result.isConfirmed) {
						let data = new FormData();
						data.append("sector", self.frmDatosSector.sector);
						data.append("descripcion", self.frmDatosSector.descripcion);

						await axios
							.post("http://laravel.test/api/sectores", data)
							.then(function (response) {
								let status = response.status;
								if (status == 200) {
									self.$parent.ListarSectores();
									self.Cerrar();
									return self.$swal.fire({
										icon: "success",
										title: "¡ÉXITO!",
										text: "El registro se agregó correctamente.",
									});
								}
							});
					}
				});
		},
		Actualizar() {
			let self = this;
			if (this.frmDatosSector.sector == null) {
				this.$swal.fire({
					icon: "error",
					title: "¡Ups!",
					text: "El SECTOR no puede quedar vacío.",
				});
				return false;
			}

			this.$swal
				.fire({
					icon: "question",
					text: "¿DESEA GUARDAR LOS CAMBIOS?",
					confirmButtonText: "Si",
					showCancelButton: true,
					cancelButtonText: "No",
					allowOutsideClick: false,
				})
				.then((result) => {
					if (result.isConfirmed) {
						let sector_id = self.frmDatosSector.id;

						let data = {
							sector: self.frmDatosSector.sector,
							descripcion: self.frmDatosSector.descripcion,
							habilitado: self.frmDatosSector.habilitado,
						};

						axios
							.put("http://laravel.test/api/sectores/" + sector_id, data)
							.then(function (response) {
								let status = response.status;
								if (status == 200) {
									self.$parent.ListarSectores();
									self.Cerrar();
									return self.$swal.fire({
										icon: "success",
										title: "¡ÉXITO!",
										text: "El registro se actualizó correctamente.",
									});
								}
							});
					}
				});
		},
	},
};
</script>

<style class="css">
/* #mdlDatosSector {
	top: 20%;
} */
</style>