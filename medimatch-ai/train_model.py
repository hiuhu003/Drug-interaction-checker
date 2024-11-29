import torch # type: ignore
import torch.nn as nn # type: ignore
import torch.optim as optim # type: ignore

class DrugInteractionModel(nn.Module):
    def __init__(self):
        super(DrugInteractionModel, self).__init__()
        self.fc1 = nn.Linear(3, 128)
        self.fc2 = nn.Linear(128, 64)
        self.fc3 = nn.Linear(64, 1)
        self.sigmoid = nn.Sigmoid()

    def forward(self, x):
        x = torch.relu(self.fc1(x))
        x = torch.relu(self.fc2(x))
        x = self.sigmoid(self.fc3(x))
        return x

# Training script (your training code goes here)
X = torch.tensor([[1.0, 0.5, 0.2], [0.5, 1.0, 0.4], [0.2, 0.3, 0.1]], dtype=torch.float32)
y = torch.tensor([[1.0], [0.0], [1.0]], dtype=torch.float32)
model = DrugInteractionModel()
criterion = nn.BCELoss()
optimizer = optim.Adam(model.parameters(), lr=0.001)

for epoch in range(100):
    model.train()
    optimizer.zero_grad()
    outputs = model(X)
    loss = criterion(outputs, y)
    loss.backward()
    optimizer.step()
    if (epoch + 1) % 10 == 0:
        print(f"Epoch [{epoch+1}/100], Loss: {loss.item():.4f}")

# Save the trained model
torch.save(model.state_dict(), 'model.pth')
print("Model saved as 'model.pth'")
