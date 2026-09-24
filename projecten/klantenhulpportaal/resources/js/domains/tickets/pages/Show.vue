<script setup lang="ts">
import { useRoute } from 'vue-router';
import { TicketStore } from '../store';
import { categoriesStore } from '../../categories/store';
import { currentUser, userStore } from '../../user/store';
import { getAllResponsesByTicket, responseStore } from '../../responses/store';
import AssignAdminForm from '../components/AssignAdminForm.vue';
import { Ticket } from '../types';
import StatusForm from '../components/StatusForm.vue';
import { Response } from '../../responses/types';
import { Ref, ref } from 'vue';
import ShowNoteResponse from '../components/ShowNoteResponse.vue';
import { Note } from '../../notes/types';
import { getAllNotesByTicket, noteStore } from '../../notes/store';
import NoteResponseForm from '../components/NoteResponseForm.vue';
import ConfirmationModal from '../../../components/ConfirmationModal.vue';

const route = useRoute();

TicketStore.actions.getAll();
categoriesStore.actions.getAll();
userStore.actions.getAll();

const ticket = TicketStore.getters.byId(Number(route.params.id));

const newResponse: Ref<Response> = ref({
    body: '',
    ticket_id: Number(route.params.id),
    user_id: currentUser.value.id,
});

getAllResponsesByTicket(Number(route.params.id));
const responses = responseStore.getters.all;


const newNote: Ref<Note> = ref({
    body: '',
    ticket_id: Number(route.params.id),
    user_id: currentUser.value.id,
});

getAllNotesByTicket(Number(route.params.id));
const notes = noteStore.getters.all;


const showModal = ref(false);
const currentNote = ref<Note>()

const showConfirmation = (note:Note) => {
    currentNote.value = note;
    showModal.value = true;
}

const deleteNote = async() => {        
    showModal.value = false;      
    if (currentNote.value?.id){
        await noteStore.actions.delete(currentNote.value?.id);
    }
        
};



const handleTicketSubmit = async (data: Ticket) => {
    await TicketStore.actions.update(Number(route.params.id), data);
};


const handleResponseSubmit = async (data: Response) => {
    await responseStore.actions.create(data);
    await getAllResponsesByTicket(Number(route.params.id));
}

const handleResponseUpdate = async (data: Response) => {
    await responseStore.actions.update(Number(data.id), data);
    await getAllResponsesByTicket(Number(route.params.id));
}

const handleNoteSubmit = async (data: Note) => {
    await noteStore.actions.create(data);
    await getAllNotesByTicket(Number(route.params.id));
}

const handleNoteUpdate = async (data: Note) => {
    await noteStore.actions.update(Number(data.id), data);
    await getAllNotesByTicket(Number(route.params.id));
}

</script>

<template>
    <div class="text-xl font-bold">Ticket: </div>
    <div v-if="ticket" class="border-1 mt-2">
        <div class="mb-1">
            <div class="text-2xl font-extrabold">Status:</div>
            <span v-if="currentUser.role === 'admin'">
                <StatusForm :ticket="ticket"  @submit="handleTicketSubmit" />
            </span>
            <span v-else>{{ ticket.status }}</span>
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Title:</div>
            {{ ticket.title }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Category:</div>
            {{ categoriesStore.getters.byId(ticket.category_id).value?.title  }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Inhoud:</div>
            {{ ticket.body }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Gemaakt door:</div>
            {{ userStore.getters.byId(ticket.user_id).value?.name }} {{ userStore.getters.byId(ticket.user_id).value?.surname }}
        </div>
        <div v-if="ticket.created_at" class="mb-1">
            <div class="text-xl font-bold">Gemaakt op:</div>
            {{ new Date(ticket.created_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
        </div>
        <div v-if="ticket.updated_at" class="mb-1">
            <div class="text-xl font-bold">Geupdate op:</div>
            {{ new Date(ticket.updated_at).toLocaleDateString(undefined, {day:'numeric', month:'long', year:'numeric'}) }}
        </div>
        <div class="mb-1">
            <div class="text-xl font-bold">Toegewezen aan:</div>
            <div v-if="currentUser.role === 'admin'">
                <AssignAdminForm :ticket="ticket"  @submit="handleTicketSubmit" />
            </div>
            <div v-else-if="ticket.assigned_to">
                {{ userStore.getters.byId(ticket.assigned_to).value?.name }} {{ userStore.getters.byId(ticket.assigned_to).value?.surname }}
            </div>
            <div v-else>
                Nog niet toegewezen.
            </div>
        </div>
    </div>
    <!-- Responses -->
    <div>
        <div class="mt-5 text-xl font-bold">Reacties:</div>
        <div v-if="responses.length > 0" v-for="response in responses">
            <ShowNoteResponse :prop="response" :what="'Reactie'" @submit="handleResponseUpdate" />
        </div>
        <div v-else>
            Nog geen reacties.
        </div>
    </div>
    <div v-if="currentUser.role === 'admin' && newResponse.user_id !== 0">
        <NoteResponseForm :prop="newResponse" :what="'Reactie'" @submit="handleResponseSubmit"/>
    </div>
    <!-- Notes -->
     <div v-if="showModal"><confirmation-modal @canceled="showModal = false" @confirmed="deleteNote" body="Weet je zeker dat je de notitie wil verwijderen?" title="currentNote.title" /></div>
    <div v-if="currentUser.role === 'admin'" class="mt-5 border-t-1">
        <div class="mt-5 text-xl font-bold">Notities:</div>
        <div v-if="notes.length > 0" v-for="note in notes">
            <ShowNoteResponse :prop="note" :what="'Note'" @submit="handleNoteUpdate" @delete="showConfirmation" />
        </div>
         <div v-if="currentUser.role === 'admin' && newNote.user_id !== 0">
        <NoteResponseForm :prop="newNote" :what="'Note'" @submit="handleNoteSubmit"/>
    </div>
    </div>
</template>