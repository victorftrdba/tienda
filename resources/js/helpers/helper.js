export const formatStatus = (value) => {
    switch (value) {
        case 'APPROVED':
            return 'APROVADO'
        case 'REJECTED':
            return 'REJEITADO'
        case 'CREATED':
            return 'CRIADO'
    }
}
