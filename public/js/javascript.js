
document.addEventListener('DOMContentLoaded', function() {
    
    const deleteBtn = document.querySelectorAll('.del')
    
    deleteBtn.forEach( button => {
        console.log('je rentre ici')
        button.addEventListener('click', event => {
            event.preventDefault();

            const dataIdBtn = button.getAttribute('data-id')
            const deleteBox = document.getElementById('confirm-del-' + dataIdBtn)
            
            deleteBox.style.display = 'flex'
        
            let confirm = document.querySelector('.confirm')
            let cancel = document.querySelector('.cancel')

            confirm.addEventListener('click', function() {
                window.location.href = this.href;
            })
                
            cancel.addEventListener('click', function() {
                deleteBox.style.display = 'none'        
            })
        })
        
        
    })
})

