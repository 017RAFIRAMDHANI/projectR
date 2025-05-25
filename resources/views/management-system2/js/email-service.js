/**
 * Email Service for Permit Management System
 * This service handles sending email notifications for permit approvals, rejections, and updates
 */

class EmailService {
    /**
     * Send an email notification
     * @param {string} to - Recipient email address
     * @param {string} subject - Email subject
     * @param {string} body - Email body content
     * @returns {Promise<boolean>} - Success status
     */
    static async sendEmail(to, subject, body) {
        // In a real implementation, this would use an email service like SendGrid, AWS SES, etc.
        console.log('Sending email:');
        console.log('To:', to);
        console.log('Subject:', subject);
        console.log('Body:', body);
        
        // Simulate email sending delay
        await new Promise(resolve => setTimeout(resolve, 500));
        
        return true;
    }

    /**
     * Send permit notification to DHI staff
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyDHI(permit) {
        const subject = `New Urgent Permit Request: ${permit.permitNumber}`;
        const body = `
            <h2>New Urgent Permit Request</h2>
            <p>A new urgent permit request requires your approval:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>Start Date:</strong> ${new Date(permit.startDateTime).toLocaleString()}</li>
                <li><strong>End Date:</strong> ${new Date(permit.endDateTime).toLocaleString()}</li>
                <li><strong>Description:</strong> ${permit.description}</li>
                <li><strong>Priority:</strong> Urgent</li>
            </ul>
            <p>Please review and approve or reject this permit request.</p>
            <p><a href="/management-system/permit-management.html">Click here to review the permit</a></p>
        `;
        
        // In a real implementation, this would be the DHI staff email
        return this.sendEmail('dhi@digitalhyperspace.com', subject, body);
    }

    /**
     * Send permit notification to Facility Management
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyFM(permit) {
        const subject = `New Permit Request: ${permit.permitNumber}`;
        const body = `
            <h2>New Permit Request</h2>
            <p>A new permit request requires your approval:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>Start Date:</strong> ${new Date(permit.startDateTime).toLocaleString()}</li>
                <li><strong>End Date:</strong> ${new Date(permit.endDateTime).toLocaleString()}</li>
                <li><strong>Description:</strong> ${permit.description}</li>
                <li><strong>Priority:</strong> ${permit.priority}</li>
            </ul>
            <p>Please review and approve or reject this permit request.</p>
            <p><a href="/management-system/fm-permit-review.html">Click here to review the permit</a></p>
        `;
        
        // In a real implementation, this would be the FM staff email
        return this.sendEmail('fm@digitalhyperspace.com', subject, body);
    }

    /**
     * Send approval notification to applicant
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyApplicantApproval(permit) {
        const subject = `Your Permit Request Has Been Approved: ${permit.permitNumber}`;
        const body = `
            <h2>Permit Request Approved</h2>
            <p>Your permit request has been approved:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>Start Date:</strong> ${new Date(permit.startDateTime).toLocaleString()}</li>
                <li><strong>End Date:</strong> ${new Date(permit.endDateTime).toLocaleString()}</li>
            </ul>
            <p>Please present this permit number at the reception desk when you arrive.</p>
            <p>Thank you for using our permit management system.</p>
        `;
        
        return this.sendEmail(permit.applicantEmail, subject, body);
    }

    /**
     * Send rejection notification to applicant
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyApplicantRejection(permit) {
        const subject = `Your Permit Request Has Been Rejected: ${permit.permitNumber}`;
        const body = `
            <h2>Permit Request Rejected</h2>
            <p>Your permit request has been rejected:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>Start Date:</strong> ${new Date(permit.startDateTime).toLocaleString()}</li>
                <li><strong>End Date:</strong> ${new Date(permit.endDateTime).toLocaleString()}</li>
            </ul>
            <p>If you have any questions, please contact the facility management team.</p>
            <p>Thank you for using our permit management system.</p>
        `;
        
        return this.sendEmail(permit.applicantEmail, subject, body);
    }

    /**
     * Send status update notification to applicant
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyApplicantStatusUpdate(permit) {
        const subject = `Your Permit Request Status Update: ${permit.permitNumber}`;
        const body = `
            <h2>Permit Request Status Update</h2>
            <p>The status of your permit request has been updated:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>Status:</strong> ${permit.status}</li>
            </ul>
            <p>We will notify you once a final decision has been made.</p>
            <p>Thank you for using our permit management system.</p>
        `;
        
        return this.sendEmail(permit.applicantEmail, subject, body);
    }

    /**
     * Send notification to DHI about FM's decision
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyDHIOfFMDecision(permit) {
        const subject = `FM has ${permit.fmStatus} permit ${permit.permitNumber}`;
        const body = `
            Dear DHI Staff,

            Facility Management has ${permit.fmStatus} the following permit:

            Permit Details:
            - Permit Number: ${permit.permitNumber}
            - Type: ${permit.permitType}
            - Location: ${permit.location}
            - Start Date: ${new Date(permit.startDateTime).toLocaleString()}
            - End Date: ${new Date(permit.endDateTime).toLocaleString()}
            - Priority: ${permit.priority}
            - Applicant: ${permit.applicantName}
            - Applicant Email: ${permit.applicantEmail}

            Best regards,
            Digital Hyperspace Indonesia
        `;

        // In a real implementation, this would send to a DHI staff email
        await this.sendEmail('dhi-staff@example.com', subject, body);
    }

    /**
     * Send notification to FM about DHI's decision
     * @param {Object} permit - Permit data
     * @returns {Promise<boolean>} - Success status
     */
    static async notifyFMOfDHIDecision(permit) {
        const subject = `DHI Decision on Permit: ${permit.permitNumber}`;
        const body = `
            <h2>DHI Decision on Permit</h2>
            <p>DHI has made a decision on the permit request:</p>
            <ul>
                <li><strong>Permit Number:</strong> ${permit.permitNumber}</li>
                <li><strong>Type:</strong> ${permit.permitType}</li>
                <li><strong>Location:</strong> ${permit.location}</li>
                <li><strong>DHI Decision:</strong> ${permit.status}</li>
                <li><strong>Reviewed By:</strong> ${permit.reviewedBy}</li>
                <li><strong>Reviewed At:</strong> ${new Date(permit.reviewedAt).toLocaleString()}</li>
            </ul>
            <p><a href="/management-system/fm-permit-review.html">Click here to view the permit</a></p>
        `;
        
        return this.sendEmail('fm@digitalhyperspace.com', subject, body);
    }

    static async notifyApplicantDHIApproval(permit) {
        const subject = `Your permit ${permit.permitNumber} has been approved by DHI`;
        const body = `
            Dear ${permit.applicantName},

            Your permit request ${permit.permitNumber} has been approved by Digital Hyperspace Indonesia.

            Permit Details:
            - Type: ${permit.permitType}
            - Location: ${permit.location}
            - Start Date: ${new Date(permit.startDateTime).toLocaleString()}
            - End Date: ${new Date(permit.endDateTime).toLocaleString()}
            - Priority: ${permit.priority}

            The permit is now being reviewed by Facility Management.

            Best regards,
            Digital Hyperspace Indonesia
        `;

        await this.sendEmail(permit.applicantEmail, subject, body);
    }

    static async notifyApplicantDHIRejection(permit) {
        const subject = `Your permit ${permit.permitNumber} has been rejected by DHI`;
        const body = `
            Dear ${permit.applicantName},

            Your permit request ${permit.permitNumber} has been rejected by Digital Hyperspace Indonesia.

            Permit Details:
            - Type: ${permit.permitType}
            - Location: ${permit.location}
            - Start Date: ${new Date(permit.startDateTime).toLocaleString()}
            - End Date: ${new Date(permit.endDateTime).toLocaleString()}
            - Priority: ${permit.priority}

            If you have any questions, please contact the DHI staff.

            Best regards,
            Digital Hyperspace Indonesia
        `;

        await this.sendEmail(permit.applicantEmail, subject, body);
    }

    static async notifyApplicantFMApproval(permit) {
        const subject = `Your permit ${permit.permitNumber} has been approved by Facility Management`;
        const body = `
            Dear ${permit.applicantName},

            Your permit request ${permit.permitNumber} has been approved by Facility Management.

            Permit Details:
            - Type: ${permit.permitType}
            - Location: ${permit.location}
            - Start Date: ${new Date(permit.startDateTime).toLocaleString()}
            - End Date: ${new Date(permit.endDateTime).toLocaleString()}
            - Priority: ${permit.priority}

            You can now proceed with your planned activities.

            Best regards,
            Digital Hyperspace Indonesia
        `;

        await this.sendEmail(permit.applicantEmail, subject, body);
    }

    static async notifyApplicantFMRejection(permit) {
        const subject = `Your permit ${permit.permitNumber} has been rejected by Facility Management`;
        const body = `
            Dear ${permit.applicantName},

            Your permit request ${permit.permitNumber} has been rejected by Facility Management.

            Permit Details:
            - Type: ${permit.permitType}
            - Location: ${permit.location}
            - Start Date: ${new Date(permit.startDateTime).toLocaleString()}
            - End Date: ${new Date(permit.endDateTime).toLocaleString()}
            - Priority: ${permit.priority}

            If you have any questions, please contact the Facility Management staff.

            Best regards,
            Digital Hyperspace Indonesia
        `;

        await this.sendEmail(permit.applicantEmail, subject, body);
    }
}

// Export the EmailService class
window.EmailService = EmailService; 