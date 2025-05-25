// Format: DHI/PERMIT/YYYY/MM/XXXX
// Example: DHI/PERMIT/2024/04/0001

class PermitNumberGenerator {
    constructor() {
        this.lastNumber = this.getLastPermitNumber();
    }

    // Get the last used permit number from localStorage
    getLastPermitNumber() {
        const lastNumber = localStorage.getItem('lastPermitNumber');
        return lastNumber ? parseInt(lastNumber) : 0;
    }

    // Generate new permit number
    generatePermitNumber() {
        const date = new Date();
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        
        // Increment the last number
        this.lastNumber++;
        
        // Save the new number to localStorage
        localStorage.setItem('lastPermitNumber', this.lastNumber.toString());
        
        // Format the sequential number with leading zeros
        const sequentialNumber = String(this.lastNumber).padStart(4, '0');
        
        // Return the complete permit number
        return `DHI/PERMIT/${year}/${month}/${sequentialNumber}`;
    }

    // Get current permit number without incrementing
    getCurrentPermitNumber() {
        const date = new Date();
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const sequentialNumber = String(this.lastNumber).padStart(4, '0');
        
        return `DHI/PERMIT/${year}/${month}/${sequentialNumber}`;
    }

    // Reset the permit number counter (for testing or admin purposes)
    resetCounter() {
        this.lastNumber = 0;
        localStorage.setItem('lastPermitNumber', '0');
    }
}

// Export the class for use in other files
window.PermitNumberGenerator = PermitNumberGenerator; 