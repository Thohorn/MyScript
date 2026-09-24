<script setup lang="ts">
    import { Ref, ref, watch } from 'vue';
    import { currentUser, userStore } from '../../user/store';   
    import { Note } from '../../notes/types';
    import { Response } from '../../responses/types';
    import { useRoute } from 'vue-router';
    import NoteResponseForm from './NoteResponseForm.vue';

    userStore.actions.getAll();

    const route = useRoute();

    const props = defineProps({ prop: Object, what: String })
    const editItem: Ref<Number> = ref(0);

    const emit = defineEmits(['submit', 'delete']);
    
    const item = ref({...props.prop});

    watch(
        () => props.prop,
        (newVal) => {
            item.value = { ...newVal }
        }
    )

    const handleSubmit = (data: Object) => {
        emit('submit', data);
        editItem.value = 0;
    }

    const handleDelete = (data: Object) => {
        emit('delete', data);
    }

</script>


<template>
    <div v-if="item.ticket_id === Number(route.params.id)" class="mb-6 mt-2 border-1">
        <div v-if="editItem !== item.id">
            <div>
                <div>{{ item.body }}</div>
                <div>{{ userStore.getters.byId(item.user_id).value?.name }} {{ userStore.getters.byId(item.user_id).value?.surname }}
                    <span v-if="item.created_at && item.created_at === item.updated_at" class="float-right">
                        {{ new Date(item.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
                    </span>
                    <span v-else-if="item.updated_at" class="float-right">(Aangepast) {{ new Date(item.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}</span>
                    <span v-if="item.id && currentUser.role === 'admin'" class="float-right mr-5">
                        <button @click="editItem = item.id">Aanpassen</button>
                        <button v-if="props.what === 'Note'" class="ml-2" @click="handleDelete(item)">Verwijderen</button>
                    </span>
                </div>
            </div>
        </div>
        <div v-else>
            <NoteResponseForm :prop="item" :what="props.what" @submit="handleSubmit" />
        </div>
    </div>

</template>