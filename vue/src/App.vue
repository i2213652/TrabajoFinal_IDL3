<template>
	<div>
		<b-table striped hover :items="items"></b-table>
	</div>
</template>

<script>
export default {
	data() {
		return {
			items: [
				{ id: 40, tipo: "Dickerson", descripcion: "Macdonald" },
				{ id: 21, tipo: "Larsen", descripcion: "Shaw" },
				{ id: 89, tipo: "Geneva", descripcion: "Wilson" },
				{ id: 38, tipo: "Jami", descripcion: "Carney" },
			],
		};
	},
};
</script>

<style>
</style>