
document.addEventListener('DOMContentLoaded', function() {
    
    const deleteBtn = document.querySelectorAll('.del')
    const table = document.querySelector('.blur')
    
    deleteBtn.forEach( button => {
        console.log('je rentre ici')
        button.addEventListener('click', event => {
            event.preventDefault();

            const dataIdBtn = button.getAttribute('data-id')
            const deleteBox = document.getElementById('confirm-del-' + dataIdBtn)
            
            deleteBox.style.display = 'block'
            table.style.filter = 'blur(5px)'
        
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

