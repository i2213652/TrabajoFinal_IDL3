<template>
	<div>
		<h1 class="text-center">LISTA DE SECTORES</h1>

		<div class="text-center">
			<b-button variant="primary" @click="Nuevo">Agregar</b-button>
		</div>
		<br />
		<div class="col-md-8 offset-md-2">
			<b-table
				:sticky-header="true"
				:no-border-collapse="false"
				responsive
				:items="lista_sectores"
				:fields="columnas"
			>
				<!-- We are using utility class `text-nowrap` to help illustrate horizontal scrolling -->

				<template #head()="scope">
					<div class="text-nowrap">{{ scope.label }}</div>
				</template>

				<template #cell(N°)="data">
					{{ data.index + 1 }}
				</template>
				<template #cell(habilitado)="data">
					{{ data.item.habilitado ? "SI" : "NO" }}
				</template>

				<template #cell(acciones)="{ item }">
					<b-button-group>
						<b-btn variant="warning" @click="Editar(item)">Editar</b-btn>
						<b-btn variant="danger" @click="Eliminar(item)">Eliminar</b-btn>
					</b-button-group>
				</template>
			</b-table>
		</div>

		<mdlDatosSector ref="mdlDatosSector"></mdlDatosSector>
	</div>
</template>

<script>
import axios from "axios";
import mdlDatosSector from "./components/mdlDatosSector.vue";
export default {
	components: { mdlDatosSector },
	props: [],
	data() {
		return {
			lista_sectores: [],
			columnas: [
				"N°",
				{ key: "sector", label: "Sector" },
				{ key: "descripcion", label: "Descripción" },
				{ key: "habilitado", label: "Habilitado" },
				{ key: "created_at", label: "Creado" },
				{ key: "updated_at", label: "Actualizado" },
				"acciones",
			],
		};
	},
	computed: {},
	mounted() {
		this.ListarSectores();
	},
	methods: {
		async ListarSectores() {
			let self = this;
			await axios
				.get("http://laravel.test/api/sectores")
				.then(function (response) {
					self.lista_sectores = response.data.data;
				});
		},

		Nuevo() {
			let mdlDatosSector = this.$refs.mdlDatosSector;
			mdlDatosSector.frmDatosSector.sector = null;
			mdlDatosSector.frmDatosSector.descripcion = null;
			mdlDatosSector.frmDatosSector.habilitado = 1;
			mdlDatosSector.modo = "NUEVO";
			mdlDatosSector.Abrir();
		},
		Editar(item) {
			let mdlDatosSector = this.$refs.mdlDatosSector;
			mdlDatosSector.frmDatosSector.id = item.id;
			mdlDatosSector.frmDatosSector.sector = item.sector;
			mdlDatosSector.frmDatosSector.descripcion = item.descripcion;
			mdlDatosSector.frmDatosSector.habilitado = item.habilitado;
			mdlDatosSector.modo = "EDITAR";
			mdlDatosSector.Abrir();
		},
		Eliminar(item) {
			let self = this;

			this.$swal
				.fire({
					icon: "question",
					text: "¿DESEA ELIMINAR ESTE SECTOR?",
					confirmButtonText: "Si",
					showCancelButton: true,
					cancelButtonText: "No",
					allowOutsideClick: false,
				})
				.then((result) => {
					if (result.isConfirmed) {
						let sector_id = item.id;

						axios
							.delete("http://laravel.test/api/sectores/" + sector_id)
							.then(function (response) {
								let status = response.status;
								if (status == 200) {
									self.ListarSectores();
									return self.$swal.fire({
										icon: "success",
										title: "¡ÉXITO!",
										text: "El registro se eliminó correctamente.",
									});
								}
							});
					}
				});
		},
	},
};
</script>

<style>
</style>