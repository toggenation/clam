import React from 'react';
import { Modal, ModalHeader, ModalBody, ModalFooter } from 'reactstrap';

const CreateModal = (props) => {
    const { showModal, click, heading } = props

    return (
      <div>
        <Modal isOpen={showModal} className={'testClass'}>
          <ModalHeader toggle={() => click()}>{heading}</ModalHeader>
          <ModalBody>
                {props.children}
          </ModalBody>
          <ModalFooter>
                {props.buttons}
          </ModalFooter>
        </Modal>
      </div>
    );
}

export default CreateModal
